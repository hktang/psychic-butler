<template>
    <td class="task-item">
        {{taskId}} - {{taskText}} 
        <task-delete-button :id="'delete-task-'+taskId" 
                            :taskId="taskId"
                            :tasks="tasks">
        </task-delete-button>
    </td>
</template>

<script>
    import TaskDeleteButton from './TaskDeleteButton.vue';

    export default {
        props: ['tasks', 'taskId', 'taskText'],
        data : function () {
            return {
                
            }
        },
        components: {
            TaskDeleteButton
        },
        mounted() {
            console.log('Component TaskItem mounted.')
        }
    }
</script>
