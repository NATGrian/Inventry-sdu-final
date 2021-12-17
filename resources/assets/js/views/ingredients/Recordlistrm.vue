<template>
  <div class="container-fluid">
    <Breadcrumb>
      <BreadcrumbItem to="/dashboard" replace>หน้าหลัก</BreadcrumbItem>
      <BreadcrumbItem to="/ingredients/list">วัตถุดิบ</BreadcrumbItem>
      <BreadcrumbItem>ภาพรวมการบันทึก นำเข้า - จ่ายออก</BreadcrumbItem>
    </Breadcrumb>
    <br>
    <Row type="flex" justify="center" align="middle">
      <Col>
      <Dropdown>
        <Button type="primary" icon="md-add" style="background-color: rgb(0, 0, 0); border-color: white;"> บันทึก </Button>
        <DropdownMenu slot="list">
          <DropdownItem><Button to="/ingredients/import" long size="small" type="text" icon="md-add" ghost style="color: #000;">บันทึก - นำเข้า</Button></DropdownItem>
          <DropdownItem><Button to="/ingredients/export" long size="small" type="text" icon="md-add" ghost style="color: #000;">บันทึก - จ่ายออก</Button></DropdownItem>
        </DropdownMenu>
      </Dropdown>
      </Col>

      <Col>
      <Button type="primary" to="/report/ingredients" icon="md-checkmark-circle-outline" style="background-color: rgb(0, 0, 0); border-color: white;">สต็อกการ์ด</Button>

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
      <Table width="872" height="400" max-height="450" border ref="selection" :columns="columns" :data="datarecord">
        
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
      addmember: false,
      addrole: false,
      columns: [
        {
          type: "selection",
          width: 50,
          align: "center",
        },
        {
          title: "ว / ด / ป",
          key: "import_at",
          width: 100,
          align: "center",
        },
        {
          title: "เลขที่ ใบส่งของ",
          key: "invoice_no",
          width: 150,
          align: "center",
        },
        {
          title: "RC / no",
          key: "rc_no",
          width: 150,
          align: "center",
        },
        {
          title: "รายการ",
          key: "itemname",
          width: 250,
          align: "center",
        },
        {
          title: "Lot No.",
          key: "LOT_no",
          width: 150,
          align: "center",
        },
        {
          title: "จำนวน",
          key: "qty_charge",
          width: 150,
          align: "center",
        },
        {
          title: "จำนวนคงเหลือ",
          key: "qty",
          width: 150,
          align: "center",
        },
        {
          title: "สถานะ",
          key: "status",
          width: 150,
          align: "center",
        },
        {
          title: "ผู้ปฎิบัติ",
          key: "firstname",
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
      datarecord: [],
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
    get("/api/recordingredients").then((res) => {
      this.datarecord = res.data.record;
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

