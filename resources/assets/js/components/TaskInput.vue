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
                <h4><span class="text-success">{{inputText}}</span> 哪里搞？</h4>
                <button v-for="space in spaces"
                :key="space.id"
                v-bind:class="[{ active: space.isActive }, 'btn btn-sm btn-default task__button']"
                v-on:click="space.isActive = !space.isActive"
                type="button">{{space.name}}</button>

                <h4><span class="text-success">{{inputText}}</span> 重复吗？</h4>
                <!-- Single button -->
                <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" 
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        每两周 <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="#">不重复</a></li>
                        <li><a href="#">每周</a></li>
                        <li><a href="#">每月</a></li>
                        <li><a href="#">每季度</a></li>
                        <li><a href="#">每半年</a></li>
                        <li><a href="#">每年</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">自定义</a></li>
                    </ul>
                </div>

                <hr/>
                <h3>{{inputText}}</h3>
                <transition-group name="fade">
                    <span class="label label-success task__label" v-for="space in spaces"
                    :key="space.id"
                    v-if="space.isActive">{{space.name}}</span>
                </transition-group>
            </div>
        </transition>
        <hr/>
        <button type="button" class="btn btn-success" v-on:click="storeTaskItem">添加</button>
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
                    if (confirm("糟糕，太久没活动，需要刷新下页面。")) location.reload();
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
