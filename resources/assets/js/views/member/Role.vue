<template>
  <div class="container-fluid">
    <Breadcrumb>
      <BreadcrumbItem to="/dashboard" replace>หน้าหลัก</BreadcrumbItem>
      <BreadcrumbItem to="/member">เจ้าหน้าที่จัดการระบบ</BreadcrumbItem>
      <BreadcrumbItem>ตำแหน่ง</BreadcrumbItem>
    </Breadcrumb>
    <br>
    <Row type="flex" justify="center" align="middle">

      <Col>
      <Button type="primary" @click="addrole = true" icon="md-add" style="background-color: rgb(0, 0, 0); border-color: white;">เพิ่มตำแหน่ง</Button>
      <Modal v-model="addrole" title="เพิ่มประเภทวัตถุดิบ" @on-ok="ok" @on-cancel="cancel" draggable reset-drag-position sticky z-index="2000">
        <p slot="header" style="color:#0040FF;text-align:center">
          <Icon type="md-add"></Icon>
          <span>เพิ่มตำแหน่ง</span>
        </p>

        <Row :model="addroles" type="flex" justify="center" align="middle">
          <Col span="18">
          <span style="width: 100%;">ระบุชื่อเรียก</span>
          <Input v-model="addroles.role" placeholder="เช่น ผู้ปฎิบัติงาน" clearable />
          </Col>

          <Col span="18">
          <span style="width: 100%;">รายละเอียด</span>
          <Input v-model="addroles.description" type="textarea" :autosize="{minRows: 2,maxRows: 5}" placeholder="เช่น ตำแหน่งคนในองกรณ์" />
          </Col>

        </Row>

        <div slot="footer" style="text-align:center">
          <Button icon="md-checkmark" size="large" style="color:#000;text-align:center border: #000 solid 2px; background-color: rgb(255, 255, 255);" @click="ok">ยืนยันการเพิ่ม</Button>
        </div>
      </Modal>
      </Col>

      <Col span="9" offset="1">
      <Input search placeholder="Enter something..." style="width: 350px" />
      </Col>

      <Col>
      <Tooltip content="export to PDF" placement="top">
        <Button shape="circle" icon="md-archive" size="large" />
      </Tooltip>
      </Col>

      <Col>
      <Tooltip content="export to csv" placement="top">
        <Button shape="circle" icon="md-archive" size="large" />
      </Tooltip>
      </Col>

      <Col>
      <Tooltip content="สั่งปลิ้น" placement="top">
        <Button shape="circle" icon="md-print" size="large" />
      </Tooltip>
      </Col>

      <Col>
      <Tooltip content="ลบตาราง" placement="top">
        <Button shape="circle" icon="md-trash" size="large" />
      </Tooltip>
      </Col>
    </Row>
    <br>
    <Row type="flex" justify="center">
      <Table highlight-row width="653" height="400" max-height="450" border ref="selection" :columns="columns" :data="roledata" size="small" :loading="loading">
        <template slot-scope="{ row }" slot="role">
          <strong>{{ row.role }}</strong>
        </template>
        <template slot-scope="{ index }" slot="action">
          <Button type="primary" size="small" style="margin-right: 3px" @click="show(index)">View</Button>
          <Button type="error" size="small" @click="remove(index)">Delete</Button>
        </template>
        <template slot="footer">
          <Page :total="40" size="small" show-elevator show-sizer />
        </template>
      </Table>

    </Row>

  </div>
</template>


<script>
import { get, post, put } from "../../helpers/api";
export default {
  data() {
    return {
      loading: true,
      addrole: false,
      columns: [
        {
          type: "selection",
          width: 50,
          align: "center",
        },
        {
          title: "Name",
          key: "role",
          width: 200,
          align: "center",
          slot: "role",
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
      roledata: [],
      addroles: {
        role: '',
        description: ''
      }
    };
  },
  methods: {
    ok() {
      post("/api/addroles", this.addroles)
        .then((res) => {
          if (res.data.succeed) {
            
            this.addrole = false
            this.roledata.unshift(res.data.roledata)
            
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
      this.$Modal.info({
        title: "User Info",
        content: `Name：${this.data4[index].name}<br>Age：${this.data4[index].age}<br>Address：${this.data4[index].address}`,
      });
    },
    remove(index) {
      this.data4.splice(index, 1);
    },
  },
  created() {
    get("/api/roles").then((res) => {
      this.roledata = res.data.roles;
      this.loading = false;
    });
  },
};
</script>

<style>
</style>

