<template>
    <div>
            <h4><span class="text-success">{{inputText}}</span> 哪里搞？</h4>
            <button v-for="space in spaces"
            :key="space.id"
            v-bind:class="[{ active: space.isActive }, 'btn btn-sm btn-default task__button']"
            v-on:click="space.isActive = !space.isActive"
            type="button">{{space.name}}</button>
    </div>
</template>

<script>
    export default {
        props : ['inputText','spaces'],
        data : function () {
            return {
                selectedSpaceIds : [],
            }
        },
        methods : {
            getSelectedSpaceComponents() {
                var selectedSpaceIds = [];
                this.spaces.forEach(function (space) {
                    if (space.isActive) {
                        selectedSpaceIds.push(space.id);
                    }
                });
                this.selectedSpaceIds = selectedSpaceIds;
                console.log(this.selectedSpaceIds);
                return this.selectedSpaceIds;
            },
            storeTaskSpaces(task) {
                
            }
        },
        created() {
            
        },
        mounted() {
        },
    }
</script>
