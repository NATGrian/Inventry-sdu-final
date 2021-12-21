<template>
  <div class="container-fluid">
    <Breadcrumb>
      <BreadcrumbItem to="/dashboard" replace>หน้าหลัก</BreadcrumbItem>
      <BreadcrumbItem>รายการวัตถุดิบคงเหลือ</BreadcrumbItem>
    </Breadcrumb>
    <br>
    <Row type="flex" justify="center" align="middle">
      <Col>
      <Tooltip content="ไปยังหน้าการบันทึก" placement="top">
      <Button to="/ingredients/recordlist" type="primary" icon="ios-link" style="background-color: rgb(0, 0, 0); border-color: white;">บันทึก</Button>
      </Tooltip>
      </Col>

      <Col>
      <Tooltip content="ใช้สำหรับเพิ่มวัตถุดิบใหม่" placement="top">
      <Button to="/ingredients/create" type="primary" icon="md-add" style="background-color: rgb(0, 0, 0); border-color: white;">เพิ่มวัตถุดิบใหม่</Button>
      </Tooltip>
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
      <Table width="872" height="400" max-height="450" border ref="selection" :columns="columns" :data="datalist">
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
import { get } from "../../helpers/api";
export default {
  data() {
    return {
      columns: [
        {
          type: "selection",
          width: 50,
          align: "center",
        },
        {
          title: "ชื่อวัตถุดิบ",
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
    };
  },
  methods: {

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
     get("/api-inv/ingredients").then((res) => {
      this.datalist = res.data.list;
    });
   }
    
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

