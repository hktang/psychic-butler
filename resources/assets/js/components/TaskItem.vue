<template>
    <td class="task-item">
        I am a task item.
        <button type="button" class="close" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </td>
</template>

<script>
    export default {
        mounted() {
            console.log('Component TaskItem mounted.')
        }
    }
</script>
