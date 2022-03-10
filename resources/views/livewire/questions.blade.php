<div>
    <div>
        <label for="title" class="form-label">Title *</label>
        <input class="form-control" type="text" name="title" value="{{ old('title', optional($exam ?? null)->title) }}" required>
        <x-error field="title"></x-error>
    </div>
    
    <div>
        <label for="description" class="form-label">Description *</label>
        <textarea name="description" cols="30" rows="10" class="form-control" required>
            {{ old('description', optional($exam ?? null)->description) }}
        </textarea>
        <x-error field="description"></x-error>
    </div>
    
    <fieldset class="border m-5 p-3">
        <legend>Questions</legend>
        @foreach ($questions as $index => $question)
            <div class="d-flex m-5 border p-3">
                <div class="col-11 row g-3">
                    <div>
                        <label for="text" class="form-label">Text</label>
                        <input class="form-control" type="text" name="question[{{ $index }}][text]" wire:model="questions.{{ $index }}.text" required>
                        <x-error field="question[{{ $index }}][text]"></x-error>
                    </div>

                    <div id="answer_correct">Type and check correct answer</div>
                    <x-error field="question[{{ $index }}][answer_correct]"></x-error>
                    
                    @foreach (['A' => 'answer_a', 'B' => 'answer_b', 'C' => 'answer_c', 'D' => 'answer_d'] as $key => $answer)
                        <div>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="radio" name="question[{{ $index }}][answer_correct]" value="{{ $answer }}" aria-labelledby="answer_correct" {{ $question['answer_correct'] == $answer ? 'checked' : '' }}>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="question[{{ $index }}][{{ $answer }}]" wire:model="questions.{{ $index }}.{{ $answer }}" required aria-labelledby="answer_correct" placeholder="Answer {{ $key }}">
                            </div>
                            <x-error field="question[{{ $index }}][{{ $answer }}]"></x-error>
                        </div>
                    @endforeach
                </div>
                <div class="col-1 g-3">
                    <a href="#" wire:click.prevent="removeQuestion({{ $index }})" class="btn btn-danger">Remove</a>
                </div>
            </div>
        @endforeach
    
        <button class="btn btn-secondary" wire:click.prevent="addQuestion">Add another question</button>
    </fieldset>
</div>
