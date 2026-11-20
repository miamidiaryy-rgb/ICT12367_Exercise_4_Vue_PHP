<script setup>
import { ref } from 'vue'
import EmployeeList from './components/EmployeeList.vue'
import AddEmployee from './components/AddEmployee.vue'

const currentPage = ref('list')

const handleAdded = () => {
  setTimeout(() => {
    currentPage.value = 'list'
  }, 600)
}
</script>

<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
    <div class="container">
      <a class="navbar-brand fw-semibold" href="#" @click.prevent="currentPage = 'list'">
        ระบบจัดการข้อมูลพนักงาน
      </a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#mainNav"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="mainNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a
              href="#"
              class="nav-link"
              :class="{ active: currentPage === 'list', 'fw-semibold': currentPage === 'list' }"
              @click.prevent="currentPage = 'list'"
            >
              แสดงข้อมูลพนักงาน
            </a>
          </li>
          <li class="nav-item">
            <a
              href="#"
              class="nav-link"
              :class="{ active: currentPage === 'add', 'fw-semibold': currentPage === 'add' }"
              @click.prevent="currentPage = 'add'"
            >
              เพิ่มข้อมูลพนักงาน
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <EmployeeList v-if="currentPage === 'list'" @go-add="currentPage = 'add'" />
  <AddEmployee v-else @added="handleAdded" @cancel="currentPage = 'list'" />
</template>

<style>
body {
  font-family: 'Leelawadee UI', Tahoma, sans-serif;
  background-color: #ffffff;
}
</style>
