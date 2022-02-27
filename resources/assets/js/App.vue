<template>
  <div class="layout">
    <Layout>
      <Sider ref="side1" hide-trigger collapsible :collapsed-width="60" v-model="isCollapsed" breakpoint="sm" v-if="this.authState.api_token">
        <div id="Sider-layout" v-if="isCollapsed">

          <div class="demo-Logo-Collapsed">
            <avatar src="/images/Logo.png" size="large" shape="square" />
          </div>

          <Divider />
          <router-link :to="`/profile/${this.authState.user_id}`" replace>
            <div class="demo-avatar-Collapsed">
              <avatar :src="`/images/users/${users.image}`" size="large" />
            </div>
          </router-link>
          <Divider />
          <Menu width="auto" :style="{background: 'rgb(14, 14, 14)',overflow: 'hidden'}" theme="dark" :active-name="`${$route.name}`">

            <Tooltip content="หน้าหลัก" placement="right" class="tooltip-sider" transfer>
              <MenuItem name="หน้าหลัก" to="/dashboard" :style="{padding: '14px 18px' }" replace>
              <Icon type="ios-speedometer" color="#fff" size="25" />
              </MenuItem>
            </Tooltip>

            <Tooltip content="เจ้าหน้าที่ระบบ" placement="right" class="tooltip-sider" transfer>
              <MenuItem name="เจ้าหน้าที่ดูแลระบบ" to="/member" :style="{padding: '14px 18px' }" replace>
              <Icon type="md-contact" color="#fff" size="25" />
              </MenuItem>
            </Tooltip>

            <Tooltip content="เจ้าหน้าที่ที่เกี่ยวข้อง" placement="right" class="tooltip-sider" transfer>
              <MenuItem name="เจ้าหน้าที่ที่เกี่ยวข้อง" to="/people" :style="{padding: '14px 18px' }" replace>
              <Icon type="md-people" color="#fff" size="25" />
              </MenuItem>
            </Tooltip>

            <Tooltip content="สถานที่เก็บ" placement="right" class="tooltip-sider" transfer>
              <MenuItem name="สถานที่เก็บของ" to="/storage" :style="{padding: '14px 18px' }" replace>
              <Icon type="ios-home" color="#fff" size="25" />
              </MenuItem>
            </Tooltip>

            <Dropdown placement="right-start" class="tooltip-sider" transfer>
              <MenuItem name="5c" :style="{padding: '14px 18px' }" replace>
              <Icon type="ios-paper" color="#fff" size="25" />
              </MenuItem>
              <DropdownMenu slot="list" :style="{margin: '8px 15px', }">
                <!-- <DropdownItem>
                  <MenuItem name="ประเภทของ วัตถุดิบ" to="/ingredients/category" replace>ประเภทรายการ</MenuItem>
                </DropdownItem> -->
                <DropdownItem>
                  <MenuItem name="รายการวัตถุดิบ" to="/ingredients/list" replace>รายการวัตถุดิบ</MenuItem>
                </DropdownItem>
                <DropdownItem>
                  <MenuItem name="ภาพรวมการบันทึก นำเข้า - จ่ายออกวัตถุดิบ" to="/ingredients/recordlist" replace>รายการบันทึก นำเข้า-จ่ายออก</MenuItem>
                </DropdownItem>
                <DropdownItem>
                  <MenuItem name="สร้างฉลากวัตถุดิบ" to="/ingredients/create-labelling" replace>สร้างฉลากปิดวัตถุดิบ</MenuItem>
                </DropdownItem>

              </DropdownMenu>
            </Dropdown>

            <Dropdown placement="right-start" class="tooltip-sider" transfer>
              <MenuItem name="5c" :style="{padding: '14px 18px' }" replace>
              <Icon type="ios-paper" color="#fff" size="25" />
              </MenuItem>
              <DropdownMenu slot="list" :style="{margin: '8px 15px', }">
                <!-- <DropdownItem>
                  <MenuItem name="ประเภทของ วัตถุดิบ" to="/package/category" replace>ประเภทรายการ</MenuItem>
                </DropdownItem> -->
                <DropdownItem>
                  <MenuItem name="รายการบรรจุุภัณฑ์" to="/package/list" replace>รายการบรรจุุภัณฑ์</MenuItem>
                </DropdownItem>
                <DropdownItem>
                  <MenuItem name="รายการบันทึก นำเข้า-จ่ายออกบรรจุุภัณฑ์" to="/package/recordlist" replace>รายการบันทึก นำเข้า-จ่ายออก</MenuItem>
                </DropdownItem>
                <DropdownItem>
                  <MenuItem name="สร้างฉลากบรรจุุภัณฑ์" to="/package/create-labelling" replace>สร้างฉลากปิดบรรจุุภัณฑ์</MenuItem>
                </DropdownItem>

              </DropdownMenu>
            </Dropdown>

            <Dropdown placement="right-start" class="tooltip-sider" transfer>
              <MenuItem name="6c" :style="{padding: '14px 15px' }" replace>
              <Icon type="ios-paper" color="#fff" size="25" />
              </MenuItem>
              <DropdownMenu slot="list" :style="{margin: '8px 15px', }">
                <DropdownItem>
                  <MenuItem name="ประเภทของ ผลิตภัณฑ์" to="/product/category" replace>ประเภทรายการ</MenuItem>
                </DropdownItem>
                <DropdownItem>
                  <MenuItem name="รายการผลิตภัณฑ์" to="/product/list" replace>รายการผลิตภัณฑ์</MenuItem>
                </DropdownItem>
                <DropdownItem>
                  <MenuItem name="ภาพรวมการบันทึก นำเข้า - จ่ายออก(ผลิตภัณฑ์)" to="/product/recordlist" replace>รายการบันทึก นำเข้า-จ่ายออก</MenuItem>
                </DropdownItem>
              </DropdownMenu>
            </Dropdown>

            <Dropdown placement="right-start" class="tooltip-sider" transfer>
              <MenuItem name="7c" :style="{padding: '14px 15px' }" replace>
              <Icon type="ios-folder-open" color="#fff" size="25" />
              </MenuItem>
              <DropdownMenu slot="list" :style="{margin: '8px 15px', }">
                <DropdownItem>
                  <MenuItem name="สต็อกการ์ด-วัตถุดิบ" to="/report/ingredients" replace>สต็อกการ์ด วัตถุดิบ</MenuItem>
                </DropdownItem>
                <DropdownItem>
                  <MenuItem name="สต็อกการ์ด-ผลิตภัณฑ์" to="/report/package" replace>สต็อกการ์ด บรรจุุภัณฑ์</MenuItem>
                </DropdownItem>
                <DropdownItem>
                  <MenuItem name="สต็อกการ์ด-ผลิตภัณฑ์" to="/report/products" replace>สต็อกการ์ด ผลิตภัณฑ์</MenuItem>
                </DropdownItem>
              </DropdownMenu>
            </Dropdown>
          </Menu>

        </div>

        <div id="Sider-layout-notcollapsed" v-else>
          <div class="demo-Logo">
            <img src="/images/Logo-1.png" style="height:60px;">
          </div>

          <Divider />
          <router-link :to="`/profile/${this.authState.user_id}`" replace>
            <div class="demo-avatar">
              <avatar :src="`/images/users/${users.image}`" size="large" />
              <span class="name-avatar"> {{ users.firstname }} </span>
            </div>
          </router-link>
          <Divider />

          <Menu :active-name="`${$route.name}`" theme="dark" width="auto" :style="{background: 'rgb(14, 14, 14)'}" class="menuitemClasses">

            <MenuItem name="หน้าหลัก" to="/dashboard" replace>
            <Icon type="ios-speedometer"></Icon>
            <span>หน้าหลัก</span>
            </MenuItem>
            <MenuItem name="เจ้าหน้าที่ดูแลระบบ" to="/member" replace>
            <Icon type="md-contact"></Icon>
            <span>เจ้าหน้าที่ระบบ</span>
            </MenuItem>
            <MenuItem name="เจ้าหน้าที่ที่เกี่ยวข้อง" to="/people" replace>
            <Icon type="md-people"></Icon>
            <span>เจ้าหน้าที่ที่เกี่ยวข้อง</span>
            </MenuItem>
            <MenuItem name="สถานที่เก็บของ" to="/storage" replace>
            <Icon type="ios-home"></Icon>
            <span>สถานที่เก็บ</span>
            </MenuItem>
            <Submenu name="5" :style="{background: 'rgb(14, 14, 14)'}">
              <template slot="title">
                <Icon type="ios-paper" />วัตถุดิบ
              </template>
              <!-- <MenuItem name="ประเภทของ วัตถุดิบ" to="/ingredients/category" replace>ประเภทรายการ</MenuItem> -->
              <MenuItem name="รายการวัตถุดิบ" to="/ingredients/list" replace>รายการวัตถุดิบ</MenuItem>
              <MenuItem name="ภาพรวมการบันทึก นำเข้า - จ่ายออกวัตถุดิบ" to="/ingredients/recordlist" replace>รายการบันทึก นำเข้า-จ่ายออก</MenuItem>
              <MenuItem name="สร้างฉลากวัตถุดิบ" to="/ingredients/create-labelling" replace>สร้างฉลากปิดวัตถุดิบ</MenuItem>
            </Submenu>
            <Submenu name="6" :style="{background: 'rgb(14, 14, 14)'}">
              <template slot="title">
                <Icon type="ios-paper" />บรรจุุภัณฑ์
              </template>
              <!-- <MenuItem name="ประเภทของ บรรจุุภัณฑ์" to="/ingredients/category" replace>ประเภทรายการ</MenuItem> -->
              <MenuItem name="รายการบรรจุุภัณฑ์" to="/package/list" replace>รายการบรรจุุภัณฑ์</MenuItem>
              <MenuItem name="ภาพรวมการบันทึก นำเข้า - จ่ายออกบรรจุุภัณฑ์" to="/package/recordlist" replace>รายการบันทึก นำเข้า-จ่ายออก</MenuItem>
              <MenuItem name="สร้างฉลากบรรจุุภัณฑ์" to="/package/create-labelling" replace>สร้างฉลากปิดบรรจุุภัณฑ์</MenuItem>
            </Submenu>
            <Submenu name="7" :style="{background: 'rgb(14, 14, 14)'}">
              <template slot="title">
                <Icon type="ios-paper" />ผลิตภัณฑ์
              </template>
              <MenuItem name="ประเภทของ ผลิตภัณฑ์" to="/product/category" replace>ประเภทรายการ</MenuItem>
              <MenuItem name="รายการผลิตภัณฑ์" to="/product/list" replace>รายการผลิตภัณฑ์</MenuItem>
              <MenuItem name="ภาพรวมการบันทึก นำเข้า - จ่ายออก(ผลิตภัณฑ์)" to="/product/recordlist" replace>รายการบันทึก นำเข้า-จ่ายออก</MenuItem>
            </Submenu>
            <Submenu name="สต็อกการ์ด" :style="{background: 'rgb(14, 14, 14)'}">
              <template slot="title">
                <Icon type="ios-folder-open" />สต็อกการ์ด
              </template>
              <MenuItem name="สต็อกการ์ด-วัตถุดิบ" to="/report/ingredients" replace>สต็อกการ์ด วัตถุดิบ</MenuItem>              
              <MenuItem name="สต็อกการ์ด-บรรจุภัณฑ์" to="/report/package" replace>สต็อกการ์ด บรรจุุภัณฑ์</MenuItem>
              <MenuItem name="สต็อกการ์ด-ผลิตภัณฑ์" to="/report/products" replace>สต็อกการ์ด ผลิตภัณฑ์</MenuItem>
            </Submenu>

          </Menu>

        </div>
      </Sider>
      <Layout :class="Layout">
        <Row v-if="this.authState.api_token">
          <Col span="12">
          <Header class="Header" id="Header-layout">
            <Menu mode="horizontal" theme="light" :class="HeaderMenu">
              <div class="Icon-Collapsed">
                <Icon @click.native="collapsedSider" :class="rotateIcon" :style="{ color:' #000',cursor: 'pointer'}" type="md-list" size="24"></Icon>
              </div>

              <div class="layout-nav">
                <Divider type="vertical" :style=" {background: '#565656' ,height: '70%',} " />
                <div class="Icon-logout">
                  <Icon @click.stop="logout" class="menu-icon" :style="{ color:' #000',cursor: 'pointer'}" type="md-log-out" size="24"></Icon>
                </div>
              </div>
            </Menu>

          </Header>
          </Col>
        </Row>
        <Content class="Layout-with-Header" style="background-color: rgb(240, 240, 240);margin: 20px;min-height: 500px;">

          <router-view />

        </Content>
        <Footer class="layout-footer-center">&copy; ระบบคงคลัง 2021-2022 | Developed By IT - BTech 61 SDU</Footer>
      </Layout>
    </Layout>
  </div>
</template>

<script type="text/javascript">
import Auth from "./store/auth";
import Flash from "./helpers/flash";
import { post, interceptors, get } from "./helpers/api";
export default {
  data() {
    return {
      authState: Auth.state,
      flash: Flash.state,
      users: {},
      isCollapsed: false,
    };
  },
  created() {
    get("/api-inv/users/" + localStorage.getItem("user_id")).then((res) => {
      this.users = res.data.user;
      this.$Loading.finish();
      this.$forceUpdate();
    });
    this.$Message.config({
      duration: 3,
    });
    // global error http handler
    interceptors((err) => {
      if (err.response.status === 401) {
        Auth.remove();
        this.$router.push("/login");
      }

      if (err.response.status === 500) {
        Flash.setError(err.response.statusText);
      }

      if (err.response.status === 404) {
        this.$router.push("/not-found");
      }
    });
    Auth.initialize();
  },
  computed: {
    auth() {
      if (this.authState.api_token) {
        return true;
      }
      return false;
    },
    guest() {
      return !this.auth;
    },
    rotateIcon() {
      return ["menu-icon", this.isCollapsed ? "rotate-icon" : ""];
    },
    Layout() {
      return [
        this.auth ? "" : "Layout-with-sider-hide",
        "Layout-with-sider",
        this.isCollapsed ? "Layout-with-sider-Collapsed" : "",
      ];
    },
    HeaderMenu() {
      return ["HeaderMenu", this.isCollapsed ? "HeaderMenu-Collapsed" : ""];
    },
  },
  methods: {
    logout() {
      post("/api-inv/logout").then((res) => {
        if (res.data.done) {
          // remove token
          Auth.remove();
          Flash.setSuccess("You have successfully logged out.");
          this.$Loading.finish();
          window.location.href = "/login";
        }
      });
    },
    collapsedSider() {
      this.$refs.side1.toggleCollapse();
    },
  },
};
</script>

<style scoped>
.Layout-with-sider-hide {
  padding-left: 0 !important;
}
.ivu-layout {
  background: rgb(240, 240, 240);
}
.ivu-layout-sider {
  background: rgb(14, 14, 14);
  border-radius: 30px;
  box-shadow: 7px 0px 13px 3px rgba(0, 0, 0, 0.7);
  /* overflow: hidden; */
  z-index: 5000;
  position: fixed;
  height: 100%;
}
.menuitemClasses {
  overflow: auto;
}
.Icon-Collapsed {
  float: left;
  position: relative;
  width: 30px;
  height: 30px;
  top: 50%;
  transform: translateY(-50%);
}
.Icon-logout {
  float: right;
  position: relative;
  width: 30px;
  height: 30px;
  top: 50%;
  transform: translateY(-50%);
}
.layout-nav {
  position: absolute;
  top: 0;
  right: 0;
  width: 65px;
  height: 100%;
}
.Header {
  box-shadow: 0px 1px 2px 0px #000000;
  position: fixed;
  padding: 0 30px;
  width: 100%;
  background: rgb(255, 255, 255);
  z-index: 900;
  border-radius: 30px;
}

.HeaderMenu {
  width: 85%;
  height: 100%;
}

.HeaderMenu-Collapsed {
  width: 95%;
  height: 100%;
}
.layout {
  background-color: rgb(240, 240, 240);
  position: relative;
  overflow: hidden;
}
.layout-logo {
  width: 100px;
  height: 30px;
  background: #5b6270;
  border-radius: 3px;
  float: left;
  position: relative;
  top: 15px;
  left: 20px;
}

.Layout-with-sider {
  padding-left: 200px;
}

.Layout-with-sider-Collapsed {
  padding-left: 60px;
}

.Layout-with-Header {
  padding-top: 65px;
}

.layout-footer-center {
  background: rgb(240, 240, 240);
  text-align: center;
  height: 20px;
}
.menu-icon {
  position: absolute;
  transition: all 0.3s;
}
.rotate-icon {
  color: #fff;
  transform: rotateZ(-90deg) translate(50%, 50%);
}

.collapsed-menu span {
  width: 0px;
  transition: width 0.2s ease;
}
.collapsed-menu i {
  transform: translateX(5px);
  transition: font-size 0.2s ease 0.2s, transform 0.2s ease 0.2s;
  vertical-align: middle;
  font-size: 20px;
}

.demo-Logo {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 7px;
  margin-bottom: 7px;
  /* border-bottom: white 1px solid; */
  /* height: 60px; */
}

.demo-Logo-Collapsed {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 10px;
  margin-bottom: 10px;
  /* border-bottom: white 1px solid; */
  /* height: 60px; */
}
.ivu-divider-horizontal {
  margin: 7px 0;
}
.demo-avatar {
  margin: 7px;
  /* border-bottom: white 1px solid; */
}

.demo-avatar-Collapsed {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 10px;
  margin-bottom: 10px;
  /* border-bottom: white 1px solid; */
}
.tooltip-sider {
  text-align: center;
  /* width: 100%; */
}

.name-avatar {
  color: #fff;
  margin-left: 15px;
}

.ivu-select-dropdown {
  padding: 5px 0 !important;
}
</style>