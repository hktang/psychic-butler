<template>
    <button type="button"
            class="close"
            aria-label="Close"
            v-on:click="deleteTaskItem(taskId)">
        <span aria-hidden="true">&times;</span>
    </button>
</template>

<script>
    export default {
        props : ['tasks', 'taskId'],
        data : function () {
            return {
                csrf  : document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        },
        methods : {
            deleteTaskItem : function (tid) {
                axios.delete('tasks/'+tid, {
                    csrf : this.csrf,
                    id : this.taskId
                })
                .then( response => {
                    this.tasks = axios.get('tasks');
                    console.log(response);
                })
                .catch(function (error) {
                    console.log(error);
                });

                // clear input text
                this.inputText = "";
            }
        },
        mounted() {
            console.log('Component TaskDeleteButton mounted.')
        }
    }
</script>
