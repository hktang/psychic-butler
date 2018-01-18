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
            <h3>{{inputText}}</h3>
            <div class="btn-group" role="group" aria-label="Room Type">
                <button type="button" class="btn btn-default">客厅</button>
                <button type="button" class="btn btn-default">厨房</button>
                <button type="button" class="btn btn-default">浴室</button>
                <button type="button" class="btn btn-default">厕所</button>
                <button type="button" class="btn btn-default">洗漱间</button>
                <button type="button" class="btn btn-default">洗衣房</button>
                <button type="button" class="btn btn-default">卧室</button>
                <button type="button" class="btn btn-default">阳台</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data : function () {
            return {
                csrf  : document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                inputText : '',
            }
        },
        methods : {
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
        mounted() {
        },
    }
</script>
