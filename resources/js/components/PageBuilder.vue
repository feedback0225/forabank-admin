<template>
    <div class="root">
            <div class="card-body">
                <div class="form-group row">

                    <div class="col-sm-12 mb-6 mt-3 mb-sm-0">
                        <label><span style="color:red;">*</span>Title страницы</label>
                        <input
                            type="text"
                            class="form-control form-control-user"
                            id="exampleTitle"
                            placeholder="Title"
                            name="title"
                            value="">
                    </div>

                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <label><span style="color:red;">*</span>Блоки</label>
                        <a href="#" class="btn btn-sm btn-primary float-right" @click="toggleAddBlockModal()">
                            <i class="fas fa-plus"></i> Добавить блок
                        </a>

                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Список блоков</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th width="40%">Блок</th>
                                        <th width="20%">С повторяющимися элементами</th>
                                        <th width="10%">Действия</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(addedBlock, index) in blocksStore">
                                            <td>{{ addedBlock.name }}</td>
                                            <td>{{ addedBlock.iterable ? 'Да' : 'Нет' }}</td>
                                            <td style="display: flex">
                                                <a href="#"
                                                   @click="editAddingBlock(index)"
                                                   class="btn btn-primary m-2"
                                                >
                                                    <i class="fa fa-pen"></i>
                                                </a>
                                                <a class="btn btn-danger m-2" href="#" data-toggle="modal" data-target="#deleteModal">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-success btn-user float-right mb-3">Сохранить</button>
                <a class="btn btn-primary float-right mr-3 mb-3" href="#">Отменить</a>
            </div>



            <!-- Add block modal -->
            <div class="modal fade" v-bind:class="{show : showAddBlockModal, 'dis-block' : showAddBlockModal}">
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
                                    @click="chosenBlockToAdd = block.id"
                                    :class="{ active : chosenBlockToAdd === block.id }"
                                    v-for="block in blocks"
                                    :key="block.id"
                                >
                                    {{ block.name }}
                                </li>
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="toggleAddBlockModal()">Close</button>
                            <button type="button" class="btn btn-primary" @click="saveChosenBlock()">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit block data modal -->

            <div class="modal fade" v-bind:class="{show : showEditBlockModal, 'dis-block' : showEditBlockModal}">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Добавить Город</h6>
                            </div>
                            <form action="javascript:void(0);">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <div class="col-sm-12 mb-3 mt-3 mb-sm-0" v-if="isArrayEmpty(blocksStore)">
                                            Вы ничего не выбрали
                                        </div>
                                        <div v-else>
                                            <div class="col-sm-12 mb-3 mt-3 mb-sm-0" v-for="(value, key) in blocksStore[chosenBlockIndexToEdit].fields">
                                                <div v-if="isString(blocksStore[chosenBlockIndexToEdit].fields[key])">
                                                    <label><span style="color:red;">*</span>{{ key }}</label>
                                                    <input
                                                        type="text"
                                                        class="form-control form-control-user"
                                                        :class="{ false : 'is-invalid' }"
                                                        :placeholder="key"
                                                        name="city"
                                                        :value="blocksStore[chosenBlockIndexToEdit].fields[key]"
                                                        @input="updateInput(blocksStore[chosenBlockIndexToEdit].fields, key, $event)">

                                                    <!--<span class="text-danger"></span>-->
                                                </div>

                                                <div v-if="isArr(blocksStore[chosenBlockIndexToEdit].fields[key])">
                                                    <label><span style="color:red;">*</span>{{ key }} кукусики</label>
                                                    <input
                                                        type="text"
                                                        class="form-control form-control-user"
                                                        :class="{ false : 'is-invalid' }"
                                                        :placeholder="key"
                                                        name="city"
                                                        :value="blocksStore[chosenBlockIndexToEdit].fields[key]"
                                                        @input="updateInput(blocksStore[chosenBlockIndexToEdit].fields, key, $event)">

                                                    <!--<span class="text-danger"></span>-->
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="card-footer">
                                    <a class="btn btn-primary float-right mr-3 mb-3"
                                       href="#"
                                       @click="showEditBlockModal = false"
                                    >
                                        Закрыть и сохранить
                                    </a>
                                </div>
                            </form>
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
            blocksStore: [], // JSON (array) blocks store который пойдет в $landing->blocks
            showAddBlockModal: false,
            showEditBlockModal: false,
            chosenBlockToAdd: 0,
            chosenBlockIndexToEdit: 0,
        }
    },
    props: [
        'blocks'
    ],
    methods: {
        toggleAddBlockModal() {
            this.showAddBlockModal = !this.showAddBlockModal
            this.chosenBlockToAdd = 0;
        },
        saveChosenBlock() {
            for (const block of this.blocks) {
                if (block.id === parseInt(this.chosenBlockToAdd)) {
                    this.blocksStore.push(JSON.parse(JSON.stringify(block))); // Обернул в такие методы чтобы избавиться от ссылки на props.blocks
                }
            }

            this.showAddBlockModal = false;
        },
        editAddingBlock(blockId) {
            console.log(blockId);
            this.chosenBlockIndexToEdit = blockId;
            this.showEditBlockModal = true;
        },

        isArrayEmpty(arrName) {
            return arrName.length === 0;
        },

        isString(value) {
            return typeof value === 'string' || value instanceof String
        },

        isArr(value) {
            return value.constructor === Array
        },

        updateInput(obj, prop, event) {
            setTimeout(() => {
                obj[prop] = event.target.value;
            }, 500);
        }
    },
    mounted() {
        console.log(23322323);
    }
}
</script>

<style scoped>
    li.list-group-item {
        cursor: pointer;
    }

    .dis-block {
        display: block;
        padding-right: 17px;
    }
</style>
