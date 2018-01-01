<template>
    <td class="task-item">
        {{id}} - {{text}} 
        <button type="button" class="close" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </td>
</template>

<script>
    export default {
        props: ['id', 'text'],
        data : function () {
            return {
                
            }
        },
        mounted() {
            console.log('Component TaskItem mounted.')
        }
    }
</script>
