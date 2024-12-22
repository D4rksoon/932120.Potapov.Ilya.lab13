@extends('layout')

@section('title') Hello Quiz @endsection

@section('main_content')
    @if($action === 'Next' or $action === null)
        <div class="header-container">
            <p>Quiz<p>
        </div>
        <form method="post" action="/Mockups/Quiz" class="calc-container">
            @csrf
            <div style="display: none">
                <input name="operation" value="{{ $operation }}" >
                <input name="firstValue" value="{{ $firstValue }}" >
                <input name="secondValue" value="{{ $secondValue }}" >
            </div>
            <output>{{ $firstValue }} {{ $operation }} {{ $secondValue }} = </output>
            <br>
            <input type="number" name="answer" id="answer" required>
            <br>
            <input class="next-btn" type="submit" name="action" value="Next">
            <input class="finish-btn" type="submit" name="action" value="Finish">
        </form>
    @else
        <div class="header-container">
            <p>Quiz results</p>
        </div>
        <div>
            @if (!empty($answerBlocks))
                <div class="answer-count">
                    <p>Right answer {{ $correctAnswersCount }} out {{ count($answerBlocks) }}</p>
                </div>
                @foreach ($answerBlocks as $block)
                    <div class="answer-output">
                        <p> {{ $loop->iteration }}. {{ $block['firstValue'] }} {{ $block['operation'] }} {{ $block['secondValue'] }} = {{ $block['userAnswer'] }}</p>
                    </div>
                @endforeach
            @else
                <div class="answer-count">
                    <p>No results</p>
                </div>
            @endif
        </div>
    @endif
@endsection
