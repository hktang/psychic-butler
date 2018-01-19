<template>
    <div>
        <div class="form-group has-feedback">
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="glyphicon glyphicon-circle-arrow-right"></i>
                </span>
                <input class="task-item-input form-control" 
                placeholder="Add a task"
                v-model="inputText"
                v-on:keyup.enter="storeTaskItem">
            </div>
        </div>
        <transition name="fade">
            <div v-if="inputText!=''">
                <h3><span class="text-success">{{inputText}}</span> 哪里搞？</h3>
                <div class="btn-group" role="group" aria-label="Room Type">
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
        </transition>
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
                    this.spaces.forEach(function(space){space.isActive = false;});
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
