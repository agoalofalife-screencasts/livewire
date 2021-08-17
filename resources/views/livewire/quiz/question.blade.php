<div>
    <div wire:offline.class="invisible" wire:init="loadQuestion">
        <div class="container container-quiz mt-sm-5 my-1">
            <div class="question ml-sm-5 pl-sm-5 pt-2">
                @if(is_null($result))
                    <form wire:submit.prevent="next">
                        <div class="py-2 h5 "><b>{{$question}}</b></div>
                        <div class="ml-md-3 ml-sm-3 pl-md-5 pt-sm-0 pt-3" id="options">
                            @foreach($options as $key => $option)
                                <label class="options">{{$option}}
                                    <input type="radio" name="radio" wire:model="answer" value="{{$key}}"> <span class="checkmark"></span>
                                </label>
                            @endforeach
                        </div>
                        @if(is_null($answer) === false)
                            <p>Ваш ответ : {{$options[$answer]}}</p>
                        @endif
                        <div class="d-flex">
                            <div class="spinner-border text-warning m-auto" role="status" wire:loading wire:target="next, loadQuestion">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-center pt-3 justify-content-evenly">
                            <div wire:loading.remove wire:target="next">
                                <div class="ml-auto mr-sm-5">
                                    <button class="btn btn-success" {{ is_null($answer) ? 'disabled': '' }}>Следующий</button>
                                </div>
                            </div>
                        </div>

                    </form>
                @else
                    <div class="py-2 h5"><b>Вы прошли тест</b></div>
                    <div class="py-2 h5"><b>Всего правильных ответов {{$result}}</b></div>
                    <div class="py-2 h5"><b>Всего вопросов {{count($questions)}}</b></div>
                @endif
            </div>
        </div>
        <div class="position-absolute top-0 end-0 m-5 fs-4" wire:poll="getQuestions">Всего вопросов {{ count($questions) }}</div>
    </div>
</div>
