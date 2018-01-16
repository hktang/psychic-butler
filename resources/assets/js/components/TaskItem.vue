<template>
    <td class="task-item" >
        {{singleTask.id}} - {{singleTask.text}} 
        <button type="button"
            class="close"
            aria-label="Close"
            v-on:click="deleteTaskItem(singleTask.id)">
        <span aria-hidden="true">&times;</span>
    </button>
    </td>
</template>

<script>
    export default {
        props: ['task'],
        data : function () {
            return {
                singleTask : this.task,
            };
        },
        mounted() {
            console.log("Mounted:");
            console.log(this);
        },
        methods: {
            deleteTaskItem : function (tid) {
                this.$emit('single-task-deleted');
            }
        }
    }
</script>
