<template>
    <div class="root">
            <div class="card-body">
                <div class="form-group row">

                    <div class="col-sm-12 mb-6 mt-3 mb-sm-0">
                        <label><span style="color:red;">*</span>Title страницы</label>
                        <input
                            v-model="title"
                            type="text"
                            class="form-control form-control-user"
                            id="exampleTitle"
                            placeholder="Title"
                            name="title">
                    </div>

                    <div class="col-sm-12 mb-6 mt-3 mb-sm-0">
                        <label><span style="color:red;">*</span>Путь страницы</label>
                        <input
                            v-model="path"
                            type="text"
                            class="form-control form-control-user"
                            id="examplePath"
                            placeholder="domain.com/..."
                            name="title">
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
                                                <a class="btn btn-danger m-2" href="#" data-toggle="modal" data-target="#deleteModal"
                                                   @click="deleteBlockWarning(index)">
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
                <button type="submit" class="btn btn-success btn-user float-right mb-3" @click="saveNewLanding()">Сохранить</button>
                <a class="btn btn-primary float-right mr-3 mb-3" href="#">Отменить</a>
            </div>



            <!-- Add block modal -->
            <div class="modal fade" v-bind:class="{show : showAddBlockModal, 'dis-block' : showAddBlockModal}">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Добавить Блок</h5>
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
            <div class="modal fade bd-example-modal-lg edit-modal" v-bind:class="{show : showEditBlockModal, 'dis-block' : showEditBlockModal}">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
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
                                                    <label>{{ capitalizeFirstLetter(key) }}</label>
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

                                                    <div>
                                                        <label>{{ capitalizeFirstLetter(key) }}</label>
                                                        <a href="#" class="btn btn-sm btn-primary float-right"
                                                           @click="blocksStore[chosenBlockIndexToEdit].fields[key].push(blocksStore[chosenBlockIndexToEdit].fields[key][0])">
                                                            <i class="fas fa-plus"></i> Добавить
                                                        </a>
                                                    </div>

                                                    <div class="elem" v-for="(arrValue, arrIndex) in value">
                                                        <span class="elemIndex">№ {{ arrIndex + 1 }}</span>
                                                        <div class="elemInputs" v-for="(elemFieldVal, elemFieldKey) in blocksStore[chosenBlockIndexToEdit].fields[key][arrIndex]">
                                                            <input
                                                                type="text"
                                                                class="form-control form-control-user"
                                                                :class="{ false : 'is-invalid' }"
                                                                :placeholder="blocksStore[chosenBlockIndexToEdit].fields[key][arrIndex][elemFieldKey]"
                                                                name="city"
                                                                :value="blocksStore[chosenBlockIndexToEdit].fields[key][arrIndex][elemFieldKey]"
                                                                @input="updateInput(blocksStore[chosenBlockIndexToEdit].fields[key][arrIndex], elemFieldKey, $event)">

                                                        </div>
                                                    </div>

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

            <!-- Delete block modal-->
            <div class="modal fade" v-bind:class="{show : showDeleteBlockModal, 'dis-block' : showDeleteBlockModal}">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Удалить блок?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="showDeleteBlockModal = false">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="showDeleteBlockModal = false">Отмена</button>
                        <button type="button" class="btn btn-primary" @click="deleteBlock()">Удалить</button>
                    </div>
                </div>
            </div>
        </div>

            <!-- Success landing save modal-->
            <div class="modal fade" v-bind:class="{show : showInfoModal, 'dis-block' : showInfoModal}">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ infoMsg }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="showInfoModal = false">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="showInfoModal = false">Закрыть</button>
                        <button type="button" class="btn btn-primary" @click="backRedirect()">На главную</button>
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
            title: '',
            path: '',
            showAddBlockModal: false,
            showEditBlockModal: false,
            showDeleteBlockModal: false,
            showInfoModal: false,
            chosenBlockToAdd: 0,
            chosenBlockToDelete: 0,
            chosenBlockIndexToEdit: 0,
            infoMsg: '',
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
            this.chosenBlockIndexToEdit = blockId;
            this.showEditBlockModal = true;
        },

        deleteBlockWarning(blockId) {
            this.showDeleteBlockModal = true;
            this.chosenBlockToDelete = blockId;
        },

        deleteBlock() {
            this.showDeleteBlockModal = false;
            this.blocksStore.splice(this.chosenBlockToDelete, 1);
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
            }, 50);
        },

        capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        },

        saveNewLanding() {
            axios.post('/landings/axios/createLanding', {
                title: this.title,
                path: this.path,
                blocks: this.blocksStore
            }).then((response) => {
                this.infoMsg = response.data.message;
                this.showInfoModal = true;
                console.log(response.data.message);
            }).catch((error) => {
                this.infoMsg = error.response.data.message;
                this.showInfoModal = true;
                console.log(error.response.data.message);
            });
        },

        backRedirect() {
            window.location.href = '../';
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

    /* Important part */
    .edit-modal .modal-dialog{
        overflow-y: initial !important
    }
    .edit-modal .modal-content{
        height: 80vh;
        overflow-y: auto;
    }

    .elemInputs {
        margin: 6px 2px;
    }

    .edit-modal label {
        font-size: 1.3rem;
        color: #4e73df;
        font-weight: 600;
    }

    .form-control {
        color: #212529 !important;
    }
</style>
