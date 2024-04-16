<template>
  <div class="wrapper2">
    <div class="menu1">
      <ul>
        <!-- <router-link exactActiveClass="m_active" tag='li' :to="{path:'/'}">Tất cả</router-link>
                <router-link exactActiveClass="m_active" tag='li' :to="{path:'/', query:{idloaitu:1, tenloai :'Danh_tu' }}">Danh từ</router-link>
                <router-link exactActiveClass="m_active" tag='li' :to="{path:'/', query:{idloaitu:2, tenloai :'Dong_tu' }}">Động từ</router-link>
                <router-link exactActiveClass="m_active" tag='li' :to="{path:'/', query:{idloaitu:2, tenloai :'Tinh_tu' }}">Tính từ</router-link> -->
        <router-link exactActiveClass="_active" tag="li" :to="{ path: '/' }"
          >Tất cả</router-link
        >
        <template if(listLoaiTu)>
          <router-link
            v-for="item in listLoaiTu"
            :key="item.id_tu"
            exactActiveClass="active"
            tag="li"
            :to="{
              path: '/',
              query: {
                id_loaitu: item.id_loai,
                tenloai: fortmat_url(item.tenloaitu),
              },
            }"
            >{{ item.tenloaitu }}</router-link
          >
        </template>
      </ul>
    </div>
    <div class="menu2">
      <ul>
        <li>
          <select
            id="form_select"
            class="form-control"
            style="width: 100%"
            @change="handleSort($event)"
          >
            <option>--Sắp xếp--</option>
            <option :value="sort.tang">Tăng dần</option>
            <option :value="sort.giam">Giảm dần</option>
          </select>
        </li>
      </ul>
    </div>
  </div>
</template>

<script >
import { mapState, mapActions, mapMutations } from "vuex";
import { removeVietnameseFromString } from "../helpers";
export default {
  name: "comp-menu-select",
  data() {
    return {
      id_loaitu: null,
      sort: {
        tang: 0,
        giam: 1,
      },
    };
  },
  computed: {
    ...mapState({
      listLoaiTu: (state) => state.voca.listLoaiTu,
    }),
  },
  methods: {
    ...mapActions(["getListTu", "getLoaiTu"]),
    ...mapMutations(["SortList"]),
    async getAll() {
      var r1 = this.getLoaiTu();
      var r2 = this.getListTu(this.id_loaitu);
      await Promise.all([r1, r2]);
    },
    fortmat_url(data) {
      return removeVietnameseFromString(data);
    },
    handleSort(event) {
      this.SortList(event.target.value);
    },
  },
  watch: {
    $route(to, from) {
      this.id_loaitu = to.query.id_loaitu;
      this.getListTu(this.id_loaitu);
    },
  },
  created() {
    this.id_loaitu = this.$route.query.id_loaitu;
    this.getAll();
  },
};
</script>

<style scoped>
._active {
  background-color: #1b5fde;
  border-radius: 10px;
  color: white;
}
.active {
  background-color: #1b5fde;
  border-radius: 10px;
  color: white;
}
.wrapper2 {
  display: flex;
  justify-content: space-around;
  background-color: #cfce9b;
}
.menu1 ul,
.menu2 ul {
  display: flex;
  padding: 0;
  margin: 0;
}
.menu1 ul li,
.menu2 ul li {
  list-style: none;
  padding: 8px 8px;
}
.menu1 {
  display: flex;
  align-items: center;
}
ul li:hover {
  background-color: #1b5fde;
  border-radius: 10px;
  color: white;
}
.card {
  padding: 0;
  margin: 0;
}
.padding_lr_0 {
  padding-left: 0px;
  padding-right: 0px;
}
.m_lr {
  margin-left: 0px;
}
.list-card {
  margin: 10px auto;
}
</style>