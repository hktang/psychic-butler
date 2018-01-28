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
                v-on:keyup.enter="storeDbTask">
            </div>
        </div>
        <transition name="fade">
            <div v-if="inputText!=''">
                <space-input :inputText="inputText"
                             :spaces="dbSpaces">
                </space-input>
                <hr/>
                <h3>{{inputText}}</h3>
                <transition-group name="fade">
                    <span class="label label-success task__label" v-for="space in dbSpaces"
                    :key="space.id"
                    v-if="space.isActive">{{space.name}}</span>
                </transition-group>
            </div>
        </transition>
        <hr/>
        <button type="button" class="btn btn-success">添加</button>
    </div>
</template>

<script>
    import SpaceInput from './SpaceInput.vue';
    export default {
        data : function () {
            return {
                dbSpaces : {},
                selectedSpaces : [],
                inputText : '',
            }
        },
        components : {
            SpaceInput,
        },
        methods : {
            storeDbTask() {
                axios.post('tasks', {
                    text : this.inputText,
                }).then( response => {
                    this.inputText = "";
                    this.dbSpaces.forEach(function(space){space.isActive=false;});
                    this.$emit('task-added', response.data);
                })
                .catch(function (error) {
                    console.log(error);
                    if (confirm("糟糕，太久没活动，需要刷新下页面。")) location.reload();
                });
            },
            getDbSpaces(){
                axios.get('spaces')
                .then( response => {
                    var dbSpaces;
                    dbSpaces = response.data;
                    dbSpaces.forEach(function(space){
                        space.isActive = false;
                    });
                    this.dbSpaces = dbSpaces;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            storeTaskSpaces(task) {
                
            }
        },
        created() {
            this.getDbSpaces();
        },
        mounted() {
        },
    }
</script>
