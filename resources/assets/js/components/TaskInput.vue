<template>
    <div class="form-group has-feedback">
        <i class="glyphicon glyphicon-ok-sign form-control-feedback"></i>
        <input class="task-item-input form-control" 
               placeholder="Add a task"
               v-model="inputText"
               v-on:keyup.enter="storeTaskItem">
    </div>
</template>

<script>
    export default {
        data : function () {
            return {
                inputText : ''
            }
        },
        methods : {
            storeTaskItem : function () {
                axios.post('tasks', {
                    text : this.inputText,
                    csrf : this.csrf
                }).then(function (response) {
                    console.log(response);
                })
                .catch(function (error) {
                    console.log(error);
                });

                this.inputText = "";
            }
        },
        mounted() {
            console.log('Component TaskInput mounted.')
        },
    }
</script>
