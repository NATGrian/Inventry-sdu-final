<template>
  <div class="container-fluid" id="categoryproduct-container">
    <Breadcrumb>
      <BreadcrumbItem to="/dashboard" replace>หน้าหลัก</BreadcrumbItem>
      <BreadcrumbItem>ประเภทผลิตภัณฑ์</BreadcrumbItem>
    </Breadcrumb>
    <br>
    <Row type="flex" justify="center" align="middle">

      <Col>
      <Button type="primary" @click="addcategory = true" icon="md-add" style="background-color: rgb(0, 0, 0); border-color: white;">เพิ่มประเภทผลิตภัณฑ์</Button>
      <Modal v-model="addcategory" title="เพิ่มประเภทผลิตภัณฑ์" @on-ok="ok" @on-cancel="cancel" draggable reset-drag-position sticky :z-index="2000">
        <p slot="header" style="color:#0040FF;text-align:center">
          <Icon type="md-add"></Icon>
          <span>เพิ่มประเภทผลิตภัณฑ์</span>
        </p>

        <Row type="flex" justify="center" align="middle" :model="categorys">
          <Col span="18">
          <span style="width: 100%;">ระบุชื่อเรียก</span>
          <Input element-id="categorys-name" v-model="categorys.name" placeholder="เช่น กึ่งสำเร็จรูป" clearable />
          </Col>

          <Col span="18">
          <span style="width: 100%;">รายละเอียด</span>
          <Input element-id="categorys-description" v-model="categorys.description" type="textarea" :autosize="{minRows: 2,maxRows: 5}" placeholder="เช่น ใช้สำหรับ ผลิตภัณฑ์" />
          </Col>

        </Row>

        <div slot="footer" style="text-align:center">
          <Button icon="md-checkmark" size="large" style="color:#000;text-align:center border: #000 solid 2px; background-color: rgb(255, 255, 255);" @click="ok">ยืนยันการเพิ่ม</Button>
        </div>
      </Modal>
      </Col>

      <Col span="9" offset="1">
      <Input search @on-search="tableItems" v-model="search" placeholder="ค้นหาตำแหน่งที่ต้องการ" style="width: 350px" />
      </Col>

      <Col>
      <Tooltip content="export to PDF" placement="top">
        <Button shape="circle" icon="md-archive" size="large" @click="exportpdf" />
      </Tooltip>
      </Col>

      <Col>
      <Tooltip content="export to csv" placement="top">
        <Button shape="circle" icon="md-archive" size="large" @click="exportcsv" />
      </Tooltip>
      </Col>
    </Row>
    <br>
    <vue-html2pdf :show-layout="false" :float-layout="true" :enable-download="true" :preview-modal="true" :paginate-elements-by-height="1100" :filename="filename" :pdf-quality="2" :manual-pagination="false" pdf-format="letter" pdf-content-width="100%" pdf-orientation="landscape" @hasStartedGeneration="hasStartedGeneration()" @hasGenerated="hasGenerated($event)" ref="html2Pdf">
      <template slot="pdf-content">
        <Row type="flex" justify="center" align="middle">
          <Col>
          <h1>รายการ ประเภทของผลิตภัณฑ์</h1>
          </Col>
        </Row>
        <br>
        <Row type="flex" justify="center" align="middle">
          <Col span="20">
          <table class="_table" ref="selection">
            <thead>
              <tr id="_header-table">
                <th>ประเภท</th>
                <th>เกี่ยวกับ</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="c in category" :key="c.id">
                <td>{{c.name}}</td>
                <td>{{c.description}}</td>
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
      <Table width="653" height="400" max-height="450" border ref="selection" :columns="columns" :data="category" :loading="loading">
        <template slot-scope="{ index }" slot="action">
          <Button type="primary" size="small" style="margin-right: 3px" @click="show(index)">View</Button>
          <Button type="error" size="small" @click="remove(index)">Delete</Button>
        </template>
        <template slot="footer">
          <Page :total="40" size="small" show-elevator show-sizer />
        </template>
      </Table>

    </Row>
    <Modal v-model="modalshow" title="ข้อมูล ประเภทของผลิตภัณฑ์" footer-hide width="500" draggable>
      <Row type="flex" justify="center" align="middle">
        <Col>
        <div style="width: 100%; "> <b style="color: #000;">ชื่อ เรียก:</b> {{ showdata.name }} </div>
        </Col>
      </Row>
      <br />
      <Row type="flex" justify="center" align="middle">
        <Col>
        <div> <b style="color: #000;">รายละเอียดย่อย:</b></div>
        </Col>
      </Row>
      <Row type="flex" justify="center" align="middle">
        <Col>
        <div> {{ showdata.description }} </div>
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
import { get, post, del } from "../../helpers/api";
export default {
  components: {
    VueHtml2pdf,
  },
  props: {
    Zindex: {
      type: Number,
      default: 2000,
    },
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
      addcategory: false,
      categorys: {
        name: '',
        description: '',
      },
      columns: [
        {
          type: "selection",
          width: 50,
          align: "center",
        },
        {
          title: "Name",
          key: "name",
          width: 200,
          align: "center",
        },
        {
          title: "เกี่ยวกับ",
          key: "description",
          width: 250,
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
      category: [],
      showdata: {
        name: "",
        description: "",
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
      const timestamps = "รายการประเภทสำหรับผลิตภัณฑ์ " + date + " " + time;
      this.filename = timestamps;
    },
    tableItems(value) {
      const data = this.category;
      if (value.length > 0) {
        if (data.filter((category) => category.name === this.search)) {
          this.category = data.filter(
            (category) => category.name.toLowerCase().indexOf(value.toLowerCase()) > -1
          );
        } else {
          this.getcategory();
        }
      } else {
        this.getcategory();
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
    ok() {
      post("/api-inv/category-p", this.categorys)
        .then((res) => {
          if (res.data.succeed) {
            
            this.addcategory = false
            this.category.unshift(res.data.categorys)
            
          }
          this.$Message.info("สำเร็จ");
        })
        .catch((err) => {
          if (err.response.status === 422) {
            this.error = err.response.data;
            this.$Message.error("เกิดข้อผิดพลาด");
            
          }
          
        });
    },
    cancel() {
        this.category.name = "",
        this.category.description = "",
        this.$Message.info("ยกเลิกแล้ว");
    },
    show(index) {
      this.modalshow = true;
      this.showdata.name = this.category[index].name;
      this.showdata.description = this.category[index].description;
    },
    confirm() {
      del("/api-inv/category-p/" + this.deletingID).then((res) => {
        this.$Loading.finish();
        this.category.splice(this.deletingIndex, 1);
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
      this.deletingID = this.category[index].id;
      this.modalConfirm = true;
    },
    getcategory () {
      get("/api-inv/category-p").then((res) => {
      this.category = res.data.category;
      this.loading = false;
    });
    },
  },
  created() {
    this.getcategory();
    setInterval(() => {
      this.timestamp();
    }, 1000);
  },
};
</script>

<style>
.demo-upload-list {
  left: 50%;
  transform: translateX(-50%);
  width: 100px;
  height: 100px;
  text-align: center;
  line-height: 60px;
  border: 1px solid transparent;
  border-radius: 4px;
  overflow: hidden;
  background: rgb(123, 123, 123);
  position: relative;
  box-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
  margin-top: 3px;
}
.demo-upload-list img {
  width: 100%;
  height: 100%;
}
.demo-upload-list-cover {
  display: none;
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(0, 0, 0, 0.6);
}
.demo-upload-list:hover .demo-upload-list-cover {
  display: block;
}
.demo-upload-list-cover i {
  color: #fff;
  font-size: 20px;
  cursor: pointer;
  margin: 0 2px;
}
</style>

