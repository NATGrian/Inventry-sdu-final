<template>
  <div class="container-fluid" id="peopleroles-container">
    <Breadcrumb>
      <BreadcrumbItem to="/dashboard" replace>หน้าหลัก</BreadcrumbItem>
      <BreadcrumbItem to="/relevants">เจ้าหน้าที่เกี่ยวข้อง</BreadcrumbItem>
      <BreadcrumbItem>ตำแหน่ง</BreadcrumbItem>
    </Breadcrumb>
    <br>
    <Row type="flex" justify="center" align="middle">

      <Col>
      <Button id="btn-addgroups" type="primary" @click="addgroups = true" icon="md-add" style="background-color: rgb(0, 0, 0); border-color: white;">เพิ่มตำแหน่ง</Button>
      <Modal id="addgroups-modal" v-model="addgroups" title="เพิ่มตำแหน่ง" @on-ok="ok" @on-cancel="cancel" draggable reset-drag-position sticky :z-index="2000">
        <p slot="header" style="color:#0040FF;text-align:center">
          <Icon type="md-add"></Icon>
          <span>เพิ่มตำแหน่ง</span>
        </p>

        <Row ref="addgroup" :model="addgroup" type="flex" justify="center" align="middle">
          <Col span="18">
          <span style="width: 100%;">ระบุชื่อเรียก</span>
          <Input element-id="addgroup-role" v-model="addgroup.role" placeholder="เช่น ผู้ปฎิบัติงาน" clearable />
          </Col>

          <Col span="18">
          <span style="width: 100%;">รายละเอียด</span>
          <Input element-id="addgroup-description" v-model="addgroup.description" type="textarea" :autosize="{minRows: 2,maxRows: 5}" placeholder="เช่น ตำแหน่งคนในองกรณ์" />
          </Col>

        </Row>

        <div slot="footer" style="text-align:center">
          <Button icon="md-checkmark" size="large" style="color:#000;text-align:center border: #000 solid 2px; background-color: rgb(255, 255, 255);" @click="ok">ยืนยันการเพิ่ม</Button>
        </div>
      </Modal>
      </Col>

      <Col span="9" offset="1">
      <Input element-id="search" search @on-search="tableItems" v-model="search" placeholder="ค้นหาตำแหน่งที่ต้องการ" style="width: 350px" />
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
          <h1>รายการ ตำแหน่ง</h1>
          </Col>
        </Row>
        <br>
        <Row type="flex" justify="center" align="middle">
          <Col span="20">
          <table class="_table" ref="selection">
            <thead>
              <tr id="_header-table">
                <th>ชื่อ ตำแหน่ง</th>
                <th>เกี่ยวกับ</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="i in groups" :key="i.id">
                <td>{{i.role}}</td>
                <td>{{i.description}}</td>
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
      <Table height="450" border ref="selection" :columns="columns" :data="groups" size="small" :loading="loading">
        <template slot-scope="{ index }" slot="action">
          <Button type="primary" size="small" style="margin-right: 3px" @click="show(index)">View</Button>
          <Button type="error" size="small" @click="remove(index)">Delete</Button>
        </template>

      </Table>

    </Row>
    <Modal v-model="modalshow" title="ข้อมูล ตำแหน่งในระบบ" footer-hide width="500" draggable>
      <Row type="flex" justify="center" align="middle">
        <Col>
        <div style="width: 100%; "> <b style="color: #000;">ชื่อ ตำแหน่ง:</b> {{ showdata.role }} </div>
        </Col>
      </Row>
      <br/>
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
      addgroups: false,
      modalConfirm: false,
      filename: "",
      search: "",
      deletingIndex: "",
      deletingID: "",
      modalshow: false,
      columns: [
        {
          title: "Name",
          key: "role",
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
          width: 150,
          align: "center",
          slot: "action",
        },
      ],
      groups: [],
      addgroup: {
        role: "",
        description: "",
      },
      showdata: {
        role: "",
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
      const timestamps = "ตำแหน่งสำหรับเจ้าหน้าที่เกี่ยวข้อง " + date + " " + time;
      this.filename = timestamps;
    },
    tableItems(value) {
      const data = this.groups;
      if (value.length > 0) {
        if (data.filter((role) => role.role === this.search)) {
          this.groups = data.filter(
            (role) => role.role.toLowerCase().indexOf(value.toLowerCase()) > -1
          );
        } else {
          this.getgroups();
        }
      } else {
        this.getgroups();
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
      post("/api-inv/addgroups", this.addgroup)
        .then((res) => {
          if (res.data.succeed) {
            this.addgroups = false;
            this.groups.unshift(res.data.group);
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

      this.$Message.info("ยกเลิกแล้ว");
    },
    show(index) {
      this.modalshow = true;
      this.showdata.role = this.groups[index].role;
      this.showdata.description = this.groups[index].description;
    },
    confirm() {
      del("/api-inv/groups/" + this.deletingID).then((res) => {
        this.$Loading.finish();
        this.groups.splice(this.deletingIndex, 1);
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
      this.deletingID = this.groups[index].id;
      this.modalConfirm = true;
    },
    getgroups() {
      get("/api-inv/groups").then((res) => {
      this.groups = res.data.groups;
      this.loading = false;
    });
    },
  },
  created() {
    this.getgroups();
    setInterval(() => {
      this.timestamp();
    }, 1000);
  },
};
</script>

<style>
</style>

