<template>
    <div class="root">
            <div class="card-body">
                <div class="form-group row">

                    <div class="col-sm-12 mb-6 mt-3 mb-sm-0">
                        <label for="name"><span style="color:red;">*</span>Title страницы</label>
                        <input
                            type="text"
                            class="form-control form-control-user"
                            id="exampleTitle"
                            placeholder="Title"
                            name="title"
                            value="">
                    </div>

                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <label for="blocks"><span style="color:red;">*</span>Блоки</label>
                        <a href="#" class="btn btn-sm btn-primary float-right" @click="showAddBlockModal = true">
                            <i class="fas fa-plus"></i> Добавить блок
                        </a>

                    </div>

                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-success btn-user float-right mb-3">Сохранить</button>
                <a class="btn btn-primary float-right mr-3 mb-3" href="#">Отменить</a>
            </div>

            <!-- Add block -->
            <div class="modal fade show" style="display: block; padding-right: 17px;">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <ul class="list-group">
                                <li class="list-group-item"
                                    @click="addBlock += 1"
                                    v-bind:class="{ active: block.id === addBlock }"
                                    v-for="block in blocks"
                                    :key="block.id"
                                >
                                    {{ block.name }}
                                </li>
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</template>

<script>
export default {
    name: "PageBuilder",
    data() {
        return {
            text: 'qwer',
            blocksIdStore: [],
            showAddBlockModal: false,
            addBlock: 0,
        }
    },
    props: [
        'blocks'
    ]
}
</script>

<style scoped>
    li.list-group-item {
        cursor: pointer;
    }
</style>
