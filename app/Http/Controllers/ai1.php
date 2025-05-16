<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ai1 extends Controller
{


    public function front_page()
    {
        return view('aispace');
    }




    public function index(Request $request)
    {
        $userInput = $request->input('question');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('DEEPSEEK_API_KEY'),
            'Content-Type' => 'application/json',
        ])->post('https://openrouter.ai/api/v1/chat/completions', [
            'model' => 'deepseek/deepseek-r1:free', // or another model name if applicable
            'messages' => [
                ['role' => 'system', 'content' => 'You are a helpful "EcoJourney planner" assistant that only answers questions about Travelling.'],
                ['role' => 'user', 'content' => $userInput],
            ],
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $rawResponse = $data['choices'][0]['message']['content'] ?? 'No response received.';
            $cleanResponse = str_replace(['**', '*','###'], '', $rawResponse);
            // return response()->json([
            //     'Question' => $userInput,
            //     'answer' => $data['choices'][0]['message']['content'] ?? 'No response received.',
            // ]);

            // Retrieve chat history from session
            $chatHistory = session()->get('chat_history', []);

            // Append new Q&A
            $chatHistory[] = [
                'question' => $userInput,
                'answer' => $cleanResponse
            ];

            // Save updated history back to session
            session(['chat_history' => $chatHistory]);
            return view('aispace',compact('chatHistory'));
        } else {
            return response()->json([
                'error' => 'API request failed.',
                'details' => $response->body(),
            ], 500);
        }
    }
}
