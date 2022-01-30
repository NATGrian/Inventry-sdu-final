<template>
  <div class="container-fluid" id="people-container">
    <Breadcrumb>
      <BreadcrumbItem to="/dashboard" replace>หน้าหลัก</BreadcrumbItem>
      <BreadcrumbItem>เจ้าหน้าที่ที่เกี่ยวข้อง</BreadcrumbItem>
    </Breadcrumb>
    <br>
    <Row type="flex" justify="center" align="middle">
      <Col>
      <Button id="btn-addpeople" type="primary" @click="addpeople = true" icon="md-add" style="background-color: rgb(0, 0, 0); border-color: white;">เพิ่มเจ้าหน้าที่</Button>
      <Modal id="addpeople-modal" v-model="addpeople" title="เพิ่มเจ้าหน้าที่ที่เกี่ยวข้อง" @on-ok="add" @on-cancel="cancel" draggable reset-drag-position sticky :z-index="2000" width="500">
        <p slot="header" style="color:#0040FF;text-align:center">
          <Icon type="md-add"></Icon>
          <span>เพิ่มเจ้าหน้าที่ที่เกี่ยวข้อง</span>

        </p>
        <Row type="flex" justify="space-between" :model="addpeoples">

          <Col>
          <Row type="flex" justify="center" ref="addpeoples">
            <Col :md="8" :sm="12" class="profile-input">
            <span style="width: 100%;">ชื่อจริง</span>
            <Input element-id="addpeoples-firstname" v-model="addpeoples.firstname" prefix="ios-contact" style="width: auto" type="text" clearable />
            </Col>
            <br>
            <Col :md="8" :sm="12" class="profile-input" offset="1">
            <span style="width: 100%;">นามสกุล</span>
            <Input element-id="addpeoples-lastname" v-model="addpeoples.lastname" prefix="ios-contact" style="width: auto" type="text" clearable />
            </Col>
          </Row>

          <br>
          <Row type="flex" justify="center">
            <Col :md="8" :sm="12" class="profile-input" offset="1">
            <span style="width: 100%;">ตำแหน่ง</span>
            <Select element-id="addpeoples-groups" v-model="addpeoples.GID" filterable>
              <Option v-for="g in groups" :value="g.id" :key="g.id">{{ g.role }}</Option>
            </Select>
            </Col>
          </Row>
          <br>
          <Row type="flex" justify="center">
            <Col :md="8" :sm="12" class="profile-input" offset="1">
            <span style="width: 100%;">รายละเอียด</span>
            <Input element-id="addpeoples-description" v-model="addpeoples.description" type="textarea" :autosize="{minRows: 2,maxRows: 5}" placeholder="......" />
            </Col>
          </Row>
          </Col>
        </Row>
        <div slot="footer" style="text-align:center">
          <Button icon="md-checkmark" size="large" style="color:#000;text-align:center border: #000 solid 2px; background-color: rgb(255, 255, 255);" @click="add">ยืนยันการเพิ่ม</Button>
        </div>
      </Modal>
      </Col>

      <Col>
      <Button id="btn_to-roles" type="primary" to="/people/roles" icon="md-add" style="background-color: rgb(0, 0, 0); border-color: white;">เพิ่มตำแหน่ง</Button>

      </Col>

      <Col span="9" offset="1">
      <Input element-id="search" search @on-search="tableItems" v-model="search" placeholder="ค้นหาชื่อที่ต้องการ" style="width: 350px" />
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
          <h1>รายชื่อ เจ้าหน้าที่เกี่ยวข้อง</h1>
          </Col>
        </Row>
        <br>
        <Row type="flex" justify="center" align="middle">
          <Col span="20">
          <table class="_table" ref="selection">
            <thead>
              <tr id="_header-table">
                <th>ชื่อ-นามสกุล</th>
                <th>ตำแหน่ง</th>
                <th>เกี่ยวกับ</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="i in datapeople" :key="i.id">
                <td>{{i.firstname}} {{i.lastname}}</td>
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
      <Table width="652" height="400" max-height="450" border ref="selection" :columns="columns" size="small" :data="datapeople" :loading="loading">
        <template slot-scope="{ index }" slot="action">
          <Button type="primary" size="small" style="margin-right: 3px" @click="show(index)">View</Button>
          <Button type="error" size="small" @click="remove(index)">Delete</Button>
        </template>
        <template slot="footer">
          <Page :total="40" size="small" show-elevator show-sizer />
        </template>
      </Table>
    </Row>
    <Modal id="modalshow" v-model="modalshow" title="ข้อมูล เจ้าหน้าที่ที่เกี่ยวข้อง" footer-hide width="700" draggable>
      <Row type="flex" justify="space-around" align="middle">
        <Col span="11">
        <p> <b style="color: #000;">ชื่อ - นามสกุล:</b> {{ showdata.firstname }} {{ showdata.lastname }} </p>
        <p> <b style="color: #000;">ตำแหน่ง:</b> {{ showdata.role }} </p>
        </Col>
        <Col span="11">
        <img :src="`/images/peoples/${showdata.image}`" alt="">
        </Col>
      </Row>

    </Modal>
    <Modal id="modalconfirm" v-model="modalConfirm" width="500" draggable @on-ok="confirm" @on-cancel="cancelcf">
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
      modalConfirm: false,
      filename: "",
      search: "",
      deletingIndex: "",
      deletingID: "",
      modalshow: false,
      addpeoples: {
        firstname: "",
        lastname: "",
        GID: "",
        description: "",
      },
      addpeople: false,
      columns: [
        {
          title: "Name",
          key: "firstname",
          width: 200,
          align: "center",
        },
        {
          title: "ตำแหน่ง",
          key: "role",
          width: 130,
          align: "center",
        },
        {
          title: "เกี่ยวกับ",
          key: "description",
          width: 120,
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
      datapeople: [],
      groups: [],
      showdata: {
        firstname: "",
        lastname: "",
        role: "",
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
      const timestamps = "เจ้าหน้าที่เกี่ยวข้อง " + date + " " + time;
      this.filename = timestamps;
    },
    tableItems(value) {
      const data = this.datapeople;
      if (value.length > 0) {
        if (data.filter((people) => people.firstname === this.search)) {
          this.datapeople = data.filter(
            (people) =>
              people.firstname.toLowerCase().indexOf(value.toLowerCase()) > -1
          );
        } else {
          this.getpeople();
        }
      } else {
        this.getpeople();
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
    add() {
      post("/api-inv/peoples", this.addpeoples)
        .then((res) => {
          if (res.data.succeed) {
            this.addpeople = false;
            this.datapeople.unshift(res.data.people);
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
        this.$refs.addpeoples.resetFields();
        this.$Message.info("ยกเลิกแล้ว");
    },
    show(index) {
      this.modalshow = true;
      this.showdata.firstname = this.datapeople[index].firstname;
      this.showdata.lastname = this.datapeople[index].lastname;
      this.showdata.role = this.datapeople[index].role;
      this.showdata.image = this.datapeople[index].image;
    },
    confirm() {
      del("api-inv/peoples/" + this.deletingID).then((res) => {
        this.$Loading.finish();
        this.datapeople.splice(this.deletingIndex, 1);
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
      this.deletingID = this.datapeople[index].id;
      this.modalConfirm = true;
    },
    getpeople() {
      get("/api-inv/peoples").then((res) => {
        this.datapeople = res.data.peoples;
        this.loading = false;
      });
    },
    getgroups() {
      get("/api-inv/groups").then((res) => {
        this.groups = res.data.groups;
      });
    },
  },

  created() {
    this.getpeople();
    this.getgroups();
    setInterval(() => {
      this.timestamp();
    }, 1000);
  },
};
</script>

<style>
</style>

