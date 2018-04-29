<template>
    <div class="card">
        <header class="card-header">
            <p class="card-header-title">
            Chat
            </p>
        </header>
        <div class="card-content">
            <div class="content" >
                <div class="messages" vue-chat-scroll>
                    <div v-for="n in messages">{{ n }}</div>
                </div>
                <div>
                    <input v-model="now" type="textarea" name="n">
                    <input type="submit" @click="update">
                </div>
            </div>
        </div>

        
        
    </div>
</template>

<script>

    

    export default {
        data(){
            return{
                messages:['one', 'two', 'three','one', 'two', 'three','one', 'two', 'three', 'one', 'two', 'three', 'one', 'two', 'three'],
                now : ''
            }
        },
        mounted() {
            
        },
        methods:{
            update(){
                this.messages.unshift();
                this.messages.push(this.now);
            }
        }

    }
</script>
