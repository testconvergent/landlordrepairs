@component('test.app')
    @slot('title')
        Home Page
    @endslot
    <div class="col-6">
        @component('test.alert',['foo' => 'bar'])
            @slot('title')
				alert
			@endslot
        @endcomponent
        <h1>Welcome</h1>
    </div>
    <div class="col-6">
        @component('test.sidebar',['foo' => 'bar'])
            <p>This is my sidebar text.</p> 
        @endcomponent
    </div>
@endcomponent