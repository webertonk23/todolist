<template>
  <div class="d-flex justify-content-center" v-if="isLoading">
    <div class="spinner-border" role="status">
      <span class="visually-hidden">Loading...</span>
    </div>
  </div>

  <div v-else>
    <h3 class="text-center mb-3">{{ lista.nome }}</h3>
    <div class="row">
      <div class="form-group col-sm-10">
        <input
          type="text"
          class="form-control"
          placeholder="Novo item"
          v-model="newItem.nome"
          @keydown.enter.prevent=""
        />
      </div>
      <button class="btn col-sm-2" @click="addItem()">
        <i class="ti ti-plus"></i>
      </button>
    </div>

    <hr />

    <div v-for="item in lista.itens" :key="item.id">
      <form @change="updateItem($event, item)">
        <div class="row">
          <input type="hidden" v-model="item.id" />
          <div class="col-sm-1">
            <input
              type="checkbox"
              v-model="item.status"
              style="margin-top: 12px"
            />
          </div>
          <div class="col">
            <input
              type="text"
              class="form-control border-0"
              v-model="item.nome"
            />
          </div>
          <div class="col-sm-2 text-end" style="margin-top: 12px">
            <i class="ti ti-trash text-danger" @click="deleteItem(item.id)"></i>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import Datepicker from "vue3-datepicker";

export default {
  props: {
    id: Number,
  },
  components: {
    Datepicker,
  },
  data() {
    return {
      newItem: {
        nome: null,
        lista_id: null,
      },
      lista: {
        id: null,
        nome: null,
      },
      itemLista: {
        id: null,
        nome: null,
        status: null,
        previsao: null,
        conclusao: null,
      },
      isLoading: false,
    };
  },
  methods: {
    async getLista() {
      this.isLoading = true;

      try {
        const response = await axios.get("/api/listas/" + this.id);
        this.lista = response.data;
      } catch (error) {
        console.error("Erro na solicitação:", error);
      } finally {
        this.isLoading = false;
      }
    },

    async addItem() {
      if (this.newItem.nome === "") {
        return;
      } else {
        this.newItem.lista_id = this.lista.id;

        const res = await fetch("/api/itens", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(this.newItem),
        })
          .then((response) => {
            if (response.status === 201) {
              this.newItem.nome = null;
              this.getLista();
            }
          })

          .catch((error) => {
            console.error("Erro na solicitação:", error);
          });
      }
    },

    async deleteItem(id) {
      const res = await fetch("/api/itens/" + id, { method: "DELETE" })
        .then((response) => {
          if (response.status === 204) {
            this.getLista();
          }
        })
        .catch((error) => {
          console.error("Erro na solicitação:", error);
        });
    },

    async updateItem(e, item) {
      e.preventDefault();
      e.stopPropagation();
      await axios
        .put("/api/itens/" + item.id, item)
        .then((response) => {
          if (response.status === 204) {
            this.getLista();
          }
        })
        .catch((error) => {
          console.error("Erro na solicitação:", error);
        });
    },
  },
  watch: {
    id: "getLista",
  },
  mounted() {
    this.getLista();
  },
};
</script>