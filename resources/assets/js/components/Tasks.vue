<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1>Tasks</h1></div>

                    <div class="panel-body">
                        <task-input></task-input>
                    </div>

                    <table class="table">
                        <tbody>
                            <tr v-for="task in tasks" :key="task.id">
                                <task-item :id="task.id" :text="task.text"></task-item>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import TaskInput from './TaskInput.vue'
    import TaskItem from './TaskItem.vue'
    export default {
        data : function (){
            return {
                csrf  : document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                tasks : {}
            }
        },
        components: {
            TaskItem, TaskInput
            },
        created() {
            axios.get('tasks')
            .then( response => {
                console.log(response);
                this.tasks = response.data;
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
