<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-5">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>添加任务</h4></div>

                    <div class="panel-body">
                        <task-input v-on:task-added="addTaskComponent"></task-input>
                    </div>
                </div>
            </div>
            <div class="col-sm-7">
                <table class="table">
                    <tbody>
                        <tr :tasks="tasks"
                        v-for="task in tasks"
                        :key="task.id">
                            <task-item 
                            v-bind:class="{ animated: task.deleted_at, 
                                bounceOutRight: task.deleted_at }"
                            v-on:single-task-deleted="deleteDbTask(task)"
                            :task="task"></task-item>
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
            }
        },
        components: {
            TaskItem, TaskInput
        },
        methods: {
            getDbTasks(){
                axios.get('tasks')
                .then( response => {
                    this.tasks = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            addTaskComponent(task){
                this.tasks.push(task);
            },
            deleteDbTask(task){
                var taskDeleteFailure = false;
                task.deleted_at = true;
                axios.delete('tasks/'+task.id, {
                    id : task.id
                }).then( response => {
                    this.getDbTasks();
                }).catch(function (error) {
                    console.log(error);
                    taskDeleteFailure = true;
                });
                if(taskDeleteFailure){
                    task.deleted_at = true;
                    if (confirm("糟糕，太久没活动，需要刷新下页面。")) location.reload();
                }
            },
        },
        created() {
            this.getDbTasks();
        },
        mounted() {
        }
    }
</script>
