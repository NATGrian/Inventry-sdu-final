<template>
  <div class="container-fluid" id="listproduct-container">
    <Breadcrumb>
      <BreadcrumbItem to="/dashboard" replace>หน้าหลัก</BreadcrumbItem>
      <BreadcrumbItem>รายการผลิตภัณฑ์คงเหลือ</BreadcrumbItem>
    </Breadcrumb>
    <br>
    <Row type="flex" justify="center" align="middle">
      <Col>
      <Tooltip content="ไปยังหน้าการบันทึก" placement="top">
        <Button to="/product/recordlist" type="primary" icon="ios-link" style="background-color: rgb(0, 0, 0); border-color: white;">บันทึก</Button>
      </Tooltip>
      </Col>

      <Col>
      <Tooltip content="ใช้สำหรับเพิ่มผลิตภัณฑ์ใหม่" placement="top">
        <Button to="/product/create" type="primary" icon="md-add" style="background-color: rgb(0, 0, 0); border-color: white;">เพิ่มผลิตภัณฑ์ใหม่</Button>
      </Tooltip>
      </Col>

      <Col span="9" offset="1">
      <Input search @on-search="tableItems" v-model="search" placeholder="ค้นหาตำแหน่งที่ต้องการ" style="width: 350px" />
      </Col>

      <Col>
      <Tooltip content="export to PDF" placement="top">
        <Button id="btn-exportpdf" shape="circle" icon="md-archive" size="large" @click="exportpdf" />
      </Tooltip>
      </Col>

      <Col>
      <Tooltip content="export to csv" placement="top">
        <Button id="btn-exportcsv" shape="circle" icon="md-archive" size="large" @click="exportcsv" />
      </Tooltip>
      </Col>
    </Row>
    <br>
    <vue-html2pdf :show-layout="false" :float-layout="true" :enable-download="true" :preview-modal="true" :paginate-elements-by-height="1100" :filename="filename" :pdf-quality="2" :manual-pagination="false" pdf-format="letter" pdf-content-width="100%" pdf-orientation="landscape" @hasStartedGeneration="hasStartedGeneration()" @hasGenerated="hasGenerated($event)" ref="html2Pdf">
      <template slot="pdf-content">
        <Row type="flex" justify="center" align="middle">
          <Col>
          <h1>รายการ คงเหลือผลิตภัณฑ์</h1>
          </Col>
        </Row>
        <br>
        <Row type="flex" justify="center" align="middle">
          <Col span="20">
          <table class="_table" ref="selection">
            <thead>
              <tr id="_header-table">
                <th>ชื่อผลิตภัณฑ์</th>
                <th>จำนวนคงเหลือ</th>
                <th>ประเภท</th>
                <th>ว-ด-ป เข้าระบบ</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="ip in datalist" :key="ip.id">
                <td>{{ip.itemname}}</td>
                <td>{{ip.qty}}</td>
                <td>{{ip.name}}</td>
                <td>{{ip.created_at}}</td>
              </tr>
            </tbody>
          </table>
          </Col>
        </Row>
        <Row type="flex" justify="end" class="code-row-bg">
          <Col>
          <Divider>
            <h6> {{filename}} </h6>
          </Divider>

          </Col>
        </Row>
      </template>
    </vue-html2pdf>
    <Row type="flex" justify="center">
      <Table width="872" height="400" max-height="450" border ref="selection" :columns="columns" :data="datalist" size="small" :loading="loading">

        <template slot-scope="{ index }" slot="action">
          <Button type="primary" size="small" style="margin-right: 3px" @click="show(index)">View</Button>
          <Button type="error" size="small" @click="remove(index)">Delete</Button>
        </template>
        <template slot="footer">
          <Page :total="40" size="small" show-elevator show-sizer />
        </template>
      </Table>

    </Row>
    <Modal v-model="modalshow" title="ข้อมูล วัตถุดิบ" footer-hide width="700" draggable>
      <Row type="flex" justify="space-around" align="middle">
        <Col span="11">
        <p> <b style="color: #000;">ชื่อวัตถุดิบ:</b> {{ showdata.itemname }} </p>
        <p> <b style="color: #000;">จำนวนคงเหลือ:</b> {{ showdata.qty }} </p>
        <p> <b style="color: #000;">ประเภท:</b> {{ showdata.name }} </p>
        <p> <b style="color: #000;">ว-ด-ป เข้าระบบ:</b> {{ showdata.created_at }} </p>
        </Col>
        <Col span="11">
        <img :src="`/images/products/${showdata.image}`" alt="">
        </Col>
      </Row>

    </Modal>

    <Modal v-model="modalConfirm" width="500" draggable @on-ok="confirm" @on-cancel="cancelcf">
      <p slot="header" style="color:#2E9AFE;text-align:center">
        <Icon type="md-help-circle" />
        <span style="color:#FF0000;">แน่ใจว่า ต้องการลบ</span>
      </p>
      <Row type="flex" justify="space-around" align="middle">
        <Col span="10">
        <Icon type="ios-trash" size="35" color="#FF0040" /> <span style="color:#482728; font-size: 20px; text-align: center;">ยืนยัน กดตกลง</span>
        </Col>

      </Row>

    </Modal>
  </div>
</template>


<script>
import VueHtml2pdf from "vue-html2pdf";
import { get, del } from "../../helpers/api";
export default {
  components: {
    VueHtml2pdf,
  },
  
  data() {
    return {
      loading: true,
      modalshow: false,
      modalConfirm: false,
      filename: "",
      search: "",
      deletingIndex: "",
      deletingID: "",
      columns: [
        {
          title: "ชื่อผลิตภัณฑ์",
          key: "itemname",
          width: 200,
          align: "center",
        },
        {
          title: "จำนวนคงเหลือ",
          key: "qty",
          width: 100,
          align: "center",
        },
        {
          title: "ประเภท",
          key: "name",
          width: 150,
          align: "center",
        },
        {
          title: "ว-ด-ป เข้าระบบ",
          key: "created_at",
          width: 230,
          align: "center",
        },
        {
          title: "ตัวเลือก",
          key: "action",
          fixed: "right",
          width: 150,
          align: "center",
          slot: "action",
        },
      ],
      datalist: [],
      showdata: {
        itemname: "",
        qty: "",
        name: "",
        created_at: "",
        image: "",
      },
    };
  },
  methods: {
    timestamp() {
      const today = new Date();
      const date =
        today.getFullYear() +
        "-" +
        (today.getMonth() + 1) +
        "-" +
        today.getDate();
      const time =
        today.getHours() + "." + today.getMinutes() + "." + today.getSeconds();
      const timestamps = "รายการคงเหลือ ผลิตภัณฑ์ " + date + " " + time;
      this.filename = timestamps;
    },
    tableItems(value) {
      const data = this.datalist;
      if (value.length > 0) {
        if (data.filter((list) => list.itemname === this.search)) {
          this.datalist = data.filter(
            (list) =>
              list.itemname.toLowerCase().indexOf(value.toLowerCase()) > -1
          );
        } else {
          this.getproducts();
        }
      } else {
        this.getproducts();
      }
    },
    exportcsv() {
      this.$refs.selection.exportCsv({
        filename: this.filename,
      });
    },
    exportpdf() {
      this.$refs.html2Pdf.generatePdf();
    },

    show(index) {
      this.modalshow = true;
      this.showdata.itemname = this.datalist[index].itemname;
      this.showdata.qty = this.datalist[index].qty;
      this.showdata.name = this.datalist[index].name;
      this.showdata.created_at = this.datalist[index].created_at;
      this.showdata.image = this.datalist[index].image;
    },
    confirm() {
      del("/api-inv/products/" + this.deletingID).then((res) => {
        this.$Loading.finish();
        this.datalist.splice(this.deletingIndex, 1);
        if (res.data.DELETE) {
          this.modalConfirm = false;
        }
        this.$Message.info("สำเร็จ");
      });
    },
    cancelcf() {
      this.modalConfirm = false;
    },
    remove(index) {
      this.deletingIndex = index;
      this.deletingID = this.datalist[index].id;
      this.modalConfirm = true;
    },
    getproducts() {
      get("/api-inv/products").then((res) => {
        this.datalist = res.data.list;
        this.loading = false;
      });
    },
  },
  created() {
    this.getproducts();
    setInterval(() => {
      this.timestamp();
    }, 1000);
  },
};
</script>

<style>
</style>

