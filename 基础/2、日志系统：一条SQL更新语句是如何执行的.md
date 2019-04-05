# 02 | 日志系统：一条SQL更新语句是如何执行的？

### 1、Redo log  物理日志
>InnoDB 的redo log  是固定大小的，分配一组固定大小的文件，从头开始写，写到末尾就回到开头循环写。
![](./img/2.png) 
>innodb_flush_log_at_trx_commit=1,表示每次提交的事务都会直接持久化到磁盘，保证MySQL异常重启数据不会丢失；
>
