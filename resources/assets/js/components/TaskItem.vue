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
                dbTask : this.task,
            };
        },
        computed: {
            singleTask : function () {
                this.dbTask.deleted = false;
                return this.dbTask;
            }
        },
        mounted() {
        },
        methods: {
            deleteTaskItem : function (tid) {
                this.$emit('single-task-deleted');
            }
        }
    }
</script>
