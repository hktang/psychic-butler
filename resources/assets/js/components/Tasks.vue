<template>
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>添加任务</h4></div>

                    <div class="panel-body">
                        <task-input v-on:task-added="addTask"></task-input>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                    <table class="table">
                        <tbody>
                            <tr :tasks="tasks"
                            v-for="task in tasks"
                            :key="task.id">
                            <transition name="fade">
                                <task-item v-if="!task.deleted_at"
                                v-on:single-task-deleted="deleteTask(task)"
                                :task="task"></task-item>
                            </transition>
                            </tr>
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</template>

<script>
    import TaskInput from './TaskInput.vue';
    import TaskItem from './TaskItem.vue';
    export default {
        data : function (){
            return {
                tasks : {},
                csrf  : document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        },
        components: {
            TaskItem, TaskInput
            },
        methods: {
            getTasks(){
                axios.get('tasks')
                .then( response => {
                    this.tasks = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            addTask(task){
                this.tasks.push(task);
            },
            deleteTask(task){
                task.deleted_at = true;
                axios.delete('tasks/'+task.id, {
                    csrf : this.csrf,
                    id : task.id
                })
                .then( response => {
                    this.getTasks();
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
        },
        created() {
            this.getTasks();
        },
        mounted() {
        }
    }
</script>
