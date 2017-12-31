<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1>Tasks</h1></div>

                    <div class="panel-body">
                    </div>

                    <table class="table">
                        <tbody>
                            <tr v-for="n in 5">
                                <task-item></task-item>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import TaskItem from './TaskItem.vue'
    export default {
        components: {
            TaskItem
            },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
