<template>
  <div class="container-fluid">
    <Breadcrumb>
      <BreadcrumbItem to="/dashboard" replace>หน้าหลัก</BreadcrumbItem>
      <BreadcrumbItem>ภาพการบันทึกผลิตภัณฑ์</BreadcrumbItem>
    </Breadcrumb>
    <br>
    <Row type="flex" justify="center" align="middle">
      <Col>
      <Dropdown>
        <Button type="primary" icon="md-add" style="background-color: rgb(0, 0, 0); border-color: white;"> บันทึก </Button>
        <DropdownMenu slot="list">
          <DropdownItem><Button to="/product/import" long size="small" type="text" icon="md-add" ghost style="color: #000;">บันทึก - นำเข้า</Button></DropdownItem>
          <DropdownItem><Button to="/product/export" long size="small" type="text" icon="md-add" ghost style="color: #000;">บันทึก - จ่ายออก</Button></DropdownItem>
        </DropdownMenu>
      </Dropdown>
      </Col>

      <Col>
      <Button type="primary" to="/report/products" icon="md-checkmark-circle-outline" style="background-color: rgb(0, 0, 0); border-color: white;">สต็อกการ์ด</Button>

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
      <Table width="872" height="400" max-height="450" border ref="selection" :columns="columns" :data="users">
        <template slot-scope="{ row }" slot="name">
          <strong>{{ row.name }}</strong>
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



export default {
  data() {
    return {
      defaultList: [
        {
          name: "",
          url: "",
        },
      ],
      model11: "",
      imgName: "",
      visible: false,
      uploadList: [],
      value9: "5555",
      addmember: false,
      addrole: false,
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
          slot: "name",
        },
        {
          title: "Mail",
          key: "email",
          width: 219,
          align: "center",
        },
        {
          title: "เบอร์โทร",
          key: "tel",
          width: 120,
          align: "center",
        },
        {
          title: "ตำแหน่ง",
          key: "role",
          width: 130,
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
      users: [],
    };
  },
  methods: {
    handleView(name) {
      this.imgName = name;
      this.visible = true;
    },
    handleRemove(file) {
      const fileList = this.$refs.upload.fileList;
      this.$refs.upload.fileList.splice(fileList.indexOf(file), 1);
    },
    handleSuccess(res, file) {
      file.url = "";
      file.name = "";
    },
    handleFormatError(file) {
      this.$Notice.warning({
        title: "The file format is incorrect",
        desc:
          "File format of " +
          file.name +
          " is incorrect, please select jpg or png.",
      });
    },
    handleMaxSize(file) {
      this.$Notice.warning({
        title: "Exceeding file size limit",
        desc: "File  " + file.name + " is too large, no more than 2M.",
      });
    },
    handleBeforeUpload() {
      const check = this.uploadList.length < 5;
      if (!check) {
        this.$Notice.warning({
          title: "Up to five pictures can be uploaded.",
        });
      }
      return check;
    },
    ok() {
      this.$Message.info("สำเร็จ");
      this.addmember = false;
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
  components: {
    
  },
  
  mounted() {
    this.uploadList = this.$refs.upload.fileList;
  },

  async created() {
    const [res, resRole] = await Promise.all([
      this.callApi("get", "app/get_users"),
    ]);
    if (res.status == 200) {
      this.users = res.data;
    } else {
      this.swr();
    }
    if (resRole.status == 200) {
      this.roles = resRole.data;
    } else {
      this.swr();
    }
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

