<template>
  <div class="container-fluid">
    <Breadcrumb>
      <BreadcrumbItem to="/dashboard" replace>หน้าหลัก</BreadcrumbItem>
      <BreadcrumbItem>เจ้าหน้าที่ที่เกี่ยวข้อง</BreadcrumbItem>
    </Breadcrumb>
    <br>
    <Row type="flex" justify="center" align="middle">
      <Col>
      <Button type="primary" @click="addpeople = true" icon="md-add" style="background-color: rgb(0, 0, 0); border-color: white;">เพิ่มเจ้าหน้าที่</Button>
      <Modal v-model="addpeople" title="เพิ่มเจ้าหน้าที่ที่เกี่ยวข้อง" @on-ok="ok" @on-cancel="cancel" draggable reset-drag-position sticky z-index="2000" width="auto">
        <p slot="header" style="color:#0040FF;text-align:center">
          <Icon type="md-add"></Icon>
          <span>เพิ่มเจ้าหน้าที่ที่เกี่ยวข้อง</span>

        </p>
        <Row type="flex" justify="space-between" :model="addpeoples">

          <Col>
          <Row type="flex" justify="center">
            <Col :md="8" :sm="12" class="profile-input">
            <span style="width: 100%;">ชื่อจริง</span>
            <Input v-model="addpeoples.firstname" prefix="ios-contact" style="width: auto" type="text" clearable />
            </Col>
            <br>
            <Col :md="8" :sm="12" class="profile-input" offset="1">
            <span style="width: 100%;">นามสกุล</span>
            <Input v-model="addpeoples.lastname" prefix="ios-contact" style="width: auto" type="text" clearable />
            </Col>
          </Row>
          
          <br>
          <Row type="flex" justify="center">
            <Col :md="8" :sm="12" class="profile-input" offset="1">
            <span style="width: 100%;">ตำแหน่ง</span>
            <Select v-model="addpeoples.GID" filterable>
              <Option v-for="g in groups" :value="g.id" :key="g.id">{{ g.role }}</Option>
            </Select>
            </Col>
          </Row>
          <br>
          <Row type="flex" justify="center">
            <Col :md="8" :sm="12" class="profile-input" offset="1">
            <span style="width: 100%;">รายละเอียด</span>
          <Input v-model="addpeoples.description" type="textarea" :autosize="{minRows: 2,maxRows: 5}" placeholder="......" />
            </Col>
          </Row>
          </Col>
        </Row>
        <div slot="footer" style="text-align:center">
          <Button icon="md-checkmark" size="large" style="color:#000;text-align:center border: #000 solid 2px; background-color: rgb(255, 255, 255);" @click="ok">ยืนยันการเพิ่ม</Button>
        </div>
      </Modal>
      </Col>

      <Col>
      <Button type="primary" @click="addrole = true" icon="md-add" style="background-color: rgb(0, 0, 0); border-color: white;">เพิ่มตำแหน่ง</Button>
      <Modal v-model="addrole" title="เพิ่มตำแหน่ง" @on-ok="ok" @on-cancel="cancel" draggable reset-drag-position sticky z-index="2000">
        <p slot="header" style="color:#0040FF;text-align:center">
          <Icon type="md-add"></Icon>
          <span>เพิ่มตำแหน่ง</span>

        </p>

        <Row type="flex" justify="center" align="middle" :model="groupsadd">
          <Col span="18">
          <span style="width: 100%;">ระบุตำแหน่งสำหรับผู้ที่เกี่ยวข้อง</span>
          <Input v-model="groupsadd.role" placeholder="เช่น ผู้เบิก" clearable />
          </Col>

          <Col span="18">
          <span style="width: 100%;">รายละเอียด</span>
          <Input v-model="groupsadd.description" type="textarea" :autosize="{minRows: 2,maxRows: 5}" placeholder="......" />
          </Col>

        </Row>

        <div slot="footer" style="text-align:center">
          <Button icon="md-checkmark" size="large" style="color:#000;text-align:center border: #000 solid 2px; background-color: rgb(255, 255, 255);" @click="addgroups">ยืนยันการเพิ่ม</Button>
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
      <Table width="652" height="400" max-height="450" border ref="selection" :columns="columns" :data="datapeople">
        <template slot-scope="{ row }" slot="name">
          <strong>{{ row.firstname }}</strong>
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
      addpeoples: {
        firstname: '',
        lastname: '',
        GID: '',
        description: '',
      },
      addpeople: false,
      addrole: false,
      columns: [
        {
          type: "selection",
          width: 50,
          align: "center",
        },
        {
          title: "Name",
          key: "firstname",
          width: 200,
          align: "center",
          slot: "name",
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
      groups:[],
      groupsadd: {
        role: '',
        description: ''
      }
    };
  },
  methods: {
    ok() {
      post("/api-inv/peoples", this.addpeoples)
        .then((res) => {
          if (res.data.succeed) {
            
            this.addpeople = false
            this.datapeople.unshift(res.data.people)
            
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
    addgroups() {
      post("/api-inv/addgroups", this.groupsadd)
        .then((res) => {
          if (res.data.succeed) {
            
            this.addrole = false
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
      this.$Modal.info({
        title: "User Info",
        content: `Name：${this.data4[index].name}<br>Age：${this.data4[index].age}<br>Address：${this.data4[index].address}`,
      });
    },
    remove(index) {
      this.datapeople.splice(index, 1);
    },
  },
  created() {
    get("/api-inv/peoples").then((res) => {
      this.datapeople = res.data.peoples;
      this.loading = false;
    });
    get("/api-inv/groups").then((res) => {
      this.groups = res.data.groups;
    });
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

