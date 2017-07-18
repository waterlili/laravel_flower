<md-input-container>
    @if(!isset($noLabel))
        <label
                @if(isset($required))
                class="md-required"
                @endif

        ><% $label %></label>
    @endif
    @yield('input')
    @if(isset($formName))
        <div ng-messages="<% $formName.'.'.$name %>.$error" role="alert">
            @if(isset($ngMessage))
                @foreach($ngMessage as $item)
                    <div ng-message="<% $item['ngMessage'] %>"><% $item['text'] %></div>
                @endforeach
            @endif
        </div>
    @endif
</md-input-container>


