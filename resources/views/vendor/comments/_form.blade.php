<!-- respond
================================================== -->
    <div class="respond">
        <h3 class="h2">Add Comment</h3>
        @if($errors->has('commentable_type'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->get('commentable_type') }}
            </div>
        @endif
        @if($errors->has('commentable_id'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->get('commentable_id') }}
            </div>
        @endif
        <form method="POST" action="{{ url('comments') }}">
            <fieldset>
            @csrf
            @honeypot
                <input type="hidden" name="commentable_type" value="\{{ get_class($model) }}" />
                <input type="hidden" name="commentable_id" value="{{ $model->id }}" />
                {{-- Guest commenting --}}
                @if(isset($guest_commenting) and $guest_commenting == true)
                    <div class="full-width">
                        <input type="text" class="full-width @if($errors->has('guest_name')) is-invalid @endif" name="guest_name" required placeholder="Enter your name here:" />
                    </div>
                    <div class="full-width">
                        <input type="email" class="full-width @if($errors->has('guest_email')) is-invalid @endif" name="guest_email" required placeholder="Enter your email here:"/>
                    </div>
                @endif
                <div class="full-width">
                    <textarea class="full-width @if($errors->has('message')) is-invalid @endif" name="message" rows="3" placeholder="Enter your message here:"></textarea>
                    <small class="form-text text-muted"><a target="_blank" href="https://help.github.com/articles/basic-writing-and-formatting-syntax">Markdown</a> cheatsheet.</small>
                </div>
                <button type="submit" class="submit btn full-width">Add Comment</button>
            </fieldset>
        </form>
    </div>
<br />
