<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CalcOperation;

class MainController extends Controller
{
    public function home()
    {
        return view('home');
    }
    public function mockups()
    {
        return view('mockups');
    }
    public function quiz()
    {
        $action = session('currentAction');
        if($action === 'Finish')
        {
            session([
                'answerBlocks' => [],
                'correctAnswersCount' => 0,
            ]);
            $action = 'Next';
            session(['currentAction' => $action]);
        }
        $firstValue = CalcOperation::randNumber();
        $secondValue = CalcOperation::randNumber();
        $operation = CalcOperation::randOperation();
        return view('quiz', compact('firstValue', 'secondValue', 'operation', 'action'));
    }
    public function quiz_next(Request $request)
    {
        $action = $request->input('action');
        $userAnswer = $request->input('answer');
        $firstValue = $request->input('firstValue');
        $secondValue = $request->input('secondValue');
        $operation = $request->input('operation');

        if(CalcOperation::checkCorrect($firstValue, $secondValue, $operation, $userAnswer)) {
            session(['correctAnswersCount' => session('correctAnswersCount') + 1]);
        }

        $answerBlocks = session('answerBlocks', []);
        $answerBlocks[] = [
            'firstValue' => $firstValue,
            'secondValue' => $secondValue,
            'operation' => $operation,
            'userAnswer' => $userAnswer,
        ];
        session(['answerBlocks' => $answerBlocks]);

        if($action === 'Next'){
            return redirect('/Mockups/Quiz');
        }
        else {
            session(['currentAction' => $action]);
            return redirect('/Mockups/Quiz/Result');
        }
    }
    public function quiz_result()
    {
        $correctAnswersCount = session('correctAnswersCount');
        $answerBlocks = session('answerBlocks', []);
        $action = 'Finish';
        return view('quiz', compact('answerBlocks', 'action', 'correctAnswersCount'));
    }
}
