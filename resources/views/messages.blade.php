@extends('layouts.app')

@section('content')

    
    <div class="card" >
        <header class="card-header">
            <p class="card-header-title">
            Chat
            </p>
        </header>
        <div class="card-content"id="d">
            <div class="content" >
                <div class="messages">
                    <div v-for="n in messages">
                        <p v-if="n.user_id==authId" style="background-color:blue;color:white;">you- @{{n.body}}</p>
                        <p v-else style="background-color:yellow;">@{{person}}- @{{n.body}}</p>
                        
                        
                    </div>
                </div>
                <div>
                   
                    <input type="text" v-model="now">
                    <input type="submit" value="Send" @click="send">
                    
                </div>
            </div>
        </div>
    </div>
   

<script src="{{ asset('js/app.js') }}"></script>
<script>

var x = new Vue({
    el:"#d",
    data:{
        messages:[],
        now: '',
        authId: {!! \Auth::id() !!},
        person: '{!! $to->name !!}',
    },
    mounted: function() {
        this.getMessages();
        this.listen();
    },
    methods:{
        getMessages(){
            axios.post('http://127.0.0.1:8000/api/messages',{
            'from': {!! \Auth::id() !!},
            'to': {!! $to->id !!},
            'api_token': '{!! \Auth::user()->api_token !!}'
            }).then(function(response){
                x.messages = response.data;
            }).catch(function(e){
                console.log(e);
            });
        },
        send(){
            
            //console.log(x.messages);
            axios.post('http://127.0.0.1:8000/api/messages/store',{
            'from': {!! \Auth::id() !!},
            'to': {!! $to->id !!},
            'api_token': '{!! \Auth::user()->api_token !!}',
            'body': x.now
            }).then(function(response){
                x.messages.push( response.data );
            }).catch(function(e){
                console.log(e);
            });
            x.now = '';
        },
        listen(){
            var channel = 'message.'+ {!! $to->id !!};
            Echo.private(channel)
            .listen('NewMessage', (e) => {
                //console.log(e.message);
                x.messages.push( e.message );
            });

        }
    }
})
</script>

@endsection

