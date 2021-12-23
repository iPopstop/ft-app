<script>
import {mapState} from 'vuex'
import { VueEditor } from "vue2-editor";

export default {
  name: 'Questions',
  metaInfo: {
    title: 'Вопросы'
  },
  components: {
    VueEditor
  },
  data: () => ({
    showCreateForm: false,
    createForm: {
      question: '',
      answer: '',
      priority: 1
    },
    loading: true,
    orderByOptions: [
      {
        value: 'id',
        translation: "ID"
      },
      {
        value: 'priority',
        translation: "Приоритет"
      },
      {
        value: 'created_at',
        translation: "Дата создания"
      },
      {
        value: 'updated_at',
        translation: "Дата обновления"
      },
    ],
    editorSettings: {
      modules: {
        imageDrop: true,
      }
    }
  }),
  computed: {
    ...mapState('questions', [
      'questions', 'search', 'edit'
    ])
  },
  created() {
    this.loadQuestions()
  },
  methods: {
    loadQuestions() {
      this.$store.dispatch('questions/index', this.search)
    },
    handleSubmit() {
      this.$store.dispatch('questions/create', this.createForm).then(() => {
        this.createForm.question = ''
        this.createForm.answer = ''
      })
    },
    openEdit(question) {
      this.$store.dispatch('questions/show', question)
      $('#editModal').modal('show')
    },
    handleUpdate() {
      this.$store.dispatch('questions/update', this.edit).then(() => {
        this.loadQuestions()
      })
    },
    handleDelete(event, id) {
      event.stopPropagation()
      this.$store.dispatch('questions/destroy', id)
    },
  },
  watch: {
    search: {
      handler(newValue, oldValue) {
        this.loadQuestions()
      },
      deep: true
    }
  }
}
</script>
<template>
  <div>
    <div v-if="!isEmpty(edit)"
         class="modal fade"
         id="editModal"
         tabindex="-1"
         role="dialog"
         aria-hidden="true"
    >
      <div class="modal-dialog modal-lg modal-dialog-centered"
           role="document"
      >
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">
              Редактирование вопроса
            </h5>
            <button type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form
              class="my-2"
              @submit.prevent="handleUpdate"
              v-if="!isEmpty(edit)"
            >
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label
                      class="control-label"
                      for="equestion"
                    >
                      Вопрос
                    </label>
                    <input
                      type="text"
                      id="equestion"
                      class="form-control"
                      placeholder="Введите вопрос"
                      v-model="edit.question"
                      required
                    >
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label
                      class="control-label"
                      for="eorder"
                    >
                      Приоритет
                    </label>
                    <input
                      type="number"
                      id="eorder"
                      class="form-control"
                      min="1"
                      max="150"
                      v-model="edit.priority"
                      required
                    >
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="eanswer">Ответ</label>
                <vue-editor id="eanswer" v-model="edit.answer" />
              </div>
            </form>
            <p v-else>
              Ошибка загрузки
            </p>
          </div>
          <div class="modal-footer">
            <button type="button"
                    class="btn btn-secondary"
                    data-dismiss="modal"
            >
              Отмена
            </button>
            <button type="button"
                    class="btn btn-primary"
                    @click="handleUpdate"
            >
              Сохранить
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="title d-flex mb-4 align-items-center justify-content-between">
      <div class="d-flex align-items-center">
        <h5 class="mb-0">Помощь</h5>
      </div>
      <div class="icons" v-if="$hasRole('admin')">
        <a
          class="icon mr-2 cursor-pointer"
          @click="showCreateForm = !showCreateForm"
        >
          <feather type="plus"/>
        </a>
      </div>
    </div>
    <transition name="fade">
      <div class="card card-body" v-if="showCreateForm">
        <form
          class="my-2"
          @submit.prevent="handleSubmit"
        >
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label
                  class="control-label"
                  for="question"
                >
                  Вопрос
                </label>
                <input
                  type="text"
                  id="question"
                  class="form-control"
                  placeholder="Введите вопрос"
                  v-model="createForm.question"
                  required
                >
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label
                  class="control-label"
                  for="order"
                >
                  Приоритет
                </label>
                <input
                  type="number"
                  id="order"
                  class="form-control"
                  min="1"
                  max="150"
                  v-model="createForm.priority"
                  required
                >
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label
                  class="control-label"
                  for="answer"
                >
                  Ответ
                </label>
                <vue-editor id="answer" v-model="createForm.answer" />
              </div>
            </div><!-- Col -->
          </div><!-- Row -->
          <button type="submit"
                  class="btn btn-primary my-3 submit"
          >
            Создать
          </button>
        </form>
      </div>
    </transition>
    <div class="card">
      <div class="card-body">
        <div id="accordion"
             class="accordion mb-4"
             role="tablist"
        >
          <div class="card"
               v-for="(question, index) in questions.data"
               :key="question.id"
          >
            <div class="card-header"
                 role="tab"
                 :id="'heading'+index"
            >

                <a
                  data-toggle="collapse"
                  :href="'#collapse'+index"
                  aria-expanded="false"
                  :aria-controls="'#collapse'+index"
                  class="collapsed text-black"
                >
                  <h6 class="mb-0">{{ question.question }}</h6>
                </a>
                <div class="btn btn-group btn-group-sm" v-if="$hasRole('admin')">
                  <button
                    class="btn btn-primary d-flex"
                    @click="openEdit(question)"
                  >
                    <feather type="edit-2"
                             class="icon-md"
                    />
                  </button>
                  <button
                    v-confirm="{
                      ok: dialog => handleDelete($event, row.id),
                      message: `Вы действительно хотите удалить вопрос #${question.id}?`
                    }"
                    type="button"
                    class="btn btn-primary d-flex"
                  >
                    <feather type="trash-2"
                             class="icon-md"
                    />
                  </button>
                </div>
            </div>
            <div :id="'collapse'+index"
                 class="collapse"
                 role="tabpanel"
                 aria-labelledby="headingOne"
                 data-parent="#accordion"
            >
              <div class="card-body">
                <div :id="'questionN'+index"
                     class="pdf-item"
                     v-html="question.answer"
                />
              </div>
            </div>
          </div>
        </div>
        <pagination-record
          :page-length.sync="search.page_length"
          :records="questions"
          :per-page="true"
          :page.sync="search.page"
          @updateRecords="loadQuestions"
        />
      </div>
    </div>
  </div>
</template>