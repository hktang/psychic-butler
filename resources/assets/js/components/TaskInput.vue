<template>
    <div>
        <div class="form-group has-feedback">
            <i class="glyphicon glyphicon-ok-sign form-control-feedback"></i>
            <input class="task-item-input form-control" 
            placeholder="Add a task"
            v-model="inputText"
            v-on:keyup.enter="storeTaskItem">
        </div>
        <div v-if="inputText!=''">
            <div class="btn-group" role="group" aria-label="Room Type">
                <button class="btn btn-sm btn-success disabled">
                    <i class="glyphicon glyphicon-home"></i>
                </button>
                <button v-for="space in spaces"
                :key="space.id"
                v-bind:class="[{ active: space.isActive }, 'btn btn-sm btn-default']"
                v-on:click="space.isActive = !space.isActive"
                type="button">{{space.name}}</button>
            </div>
            <h3>{{inputText}}</h3>
            <transition-group name="fade">
                <span class="label label-success" v-for="space in spaces"
                :key="space.id"
                v-if="space.isActive">{{space.name}}</span>
            </transition-group>
        </div>
    </div>
</template>

<script>
    export default {
        data : function () {
            return {
                csrf  : document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                spaces : {},
                inputText : '',
            }
        },
        methods : {
            getSpaces(){
                axios.get('spaces')
                .then( response => {
                    var dbSpaces;
                    dbSpaces = response.data;
                    dbSpaces.forEach(function(space){
                        space.isActive = false;
                    });
                    this.spaces = dbSpaces;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            storeTaskItem : function () {
                axios.post('tasks', {
                    text : this.inputText,
                    csrf : this.csrf
                }).then( response => {
                    this.inputText = "";
                    this.$emit('task-added', response.data);
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
        },
        created() {
            this.getSpaces();
        },
        mounted() {
        },
    }
</script>
