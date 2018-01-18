<template>
    <div>
        <div class="form-group has-feedback">
            <i class="glyphicon glyphicon-ok-sign form-control-feedback"></i>
            <input class="task-item-input form-control" 
                placeholder="Add a task"
                v-model="inputText"
                v-on:keyup.enter="storeTaskItem">
        </div>
        <div v-if="inputText!=''">
            <h3>{{inputText}}</h3>
            <div class="btn-group" role="group" aria-label="Room Type">
                <button v-for="space in spaces" :key="space.id" type="button" class="btn btn-default">{{space.name}}</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data : function () {
            return {
                csrf  : document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                spaces : {},
                inputText : '',
            }
        },
        methods : {
            getSpaces(){
                axios.get('spaces')
                .then( response => {
                    this.spaces = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            storeTaskItem : function () {
                axios.post('tasks', {
                    text : this.inputText,
                    csrf : this.csrf
                }).then( response => {
                    this.inputText = "";
                    this.$emit('task-added', response.data);
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
        },
        created() {
            this.getSpaces();
        },
        mounted() {
        },
    }
</script>
