<template>
  <div class="row d-flex">
    <div class="col-md">
      <h3 class="text-center">Listas</h3>
      <div class="row justify-content-center">
        <div
          class="row col-md-3 shadow p-3 m-1 bg-white rounded"
          v-for="(lista, i) in listas"
          :key="i"
        >
          <div class="col-md-10" @click="verLista(lista.id)">
            <h4 class="lead col-md-8" style="cursor: pointer">
              {{ lista.nome }}
            </h4>
          </div>
          <div class="col-md-2 text-end">
            <i class="ti ti-trash text-danger" @click="deleteLista(lista.id)"></i>
          </div>
        </div>

        <div class="col-md-3 shadow p-3 m-1 bg-white rounded">
          <div v-if="!novaListaCampo">
            <h4 class="lead text-center" @click="addLista()">
              <i class="ti ti-plus"></i>
            </h4>
          </div>
          <div class="row" v-else>
            <div class="form-group col-md-10">
              <input
                type="text"
                class="form-control"
                placeholder="Nova lista"
                v-model="newlista.nome"
              />
            </div>
            <button
              class="btn col-md-2"
              @click="newlista.nome ? newLista() : addLista()"
            >
              <i :class="newlista.nome ? 'ti ti-plus' : 'ti ti-x'"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4 mt-2" v-if="verListaCheck">
      <Lista :id="lista_id" @listaSelecionada="verLista"/>
    </div>
  </div>
</template>

<script>
import Lista from "./Lista.vue";

export default {
  components: { Lista },
  data() {
    return {
      listas: null,
      newlista: {
        nome: null,
      },
      newItem: {
        nome: null,
      },
      lista_id: null,
      verListaCheck: false,
      novaListaCampo: false,
    };
  },
  methods: {
    async getListas() {
      const req = await fetch("/api/listas");
      this.listas = await req.json();
    },

    addLista() {
      this.novaListaCampo = !this.novaListaCampo;
    },

    async newLista() {
      // e.preventDefault();

      if (this.novaListaCampo === "") {
        return;
      } else {
        const res = await fetch("/api/listas", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(this.newlista),
        });

        this.novaListaCampo = !this.novaListaCampo;

        this.getListas();
      }
    },

    verLista(id) {
      this.lista_id = id;
      this.verListaCheck = true;

      this.$emit('listaSelecionada', id);
    },

    async deleteLista(id) {

      const res = await fetch("/api/listas/" + id, {method: "DELETE", })
        .then((response) => {
          if (response.status === 204) {            
            this.getListas();
          }
        })
        .catch((error) => {
          console.error("Erro na solicitação:", error);
        });
    },
  },
  mounted() {
    this.getListas();
  },
};
</script>