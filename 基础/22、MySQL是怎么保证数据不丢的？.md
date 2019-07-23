#  21 | MySQL是怎么保证数据不丢的？

## binlog 的写入机制

> 事务执行的过程中，先把日志写到binlog cache 中 事务提交的时，在把binlog cache 写到binlog 文件中  

> 系统给binlog cache 分配了一块内存 每个线程一个 参数binlog_cahe_size 用于控制单个线程内存binlog cache 所占内存的大小 如果超过了这个参数规定的大小 就要暂存在磁盘
  
>1、 每个线程都有自己的binlog cache 但是公用一个binlog 文件  
>2 、write 指的是把日志写入到文件系统的apge cahce 并没有把数据持久化到磁盘，所以速度比较快  
>3、fsync 才是将数据持久化到磁盘的操作 一般情况下 我们认为fsync 才占磁盘的IOPS   

`write  和 fsync ，由参数sync_binlog 控制`
>1、 sync_binlog = 0 的时候 表示每次提交的事务都只write 不fsync   
>2、  sync_binlog = 1 ,表示每次提交的事务都会执行fsync 
>3、 sync_binlog =N (N>1) 表示每次提交事务都 write，但累积 N 个事务后才 fsync 

在出现IO瓶颈 的场景里，将sysc_binlog 设置成一个较大的值 ，可以提升性能。在实际的业务场景中，考虑到丢失日志量的可控性 一般不建议将这个参数设置为0 比较常见 的是设置为 100-1000 之间  
`风险` 如果主机异常重启 会丢失最近N个 事务的日志

## redo log 的写入机制

redo log 的三种状态
> 1、存在redo log buffer 中，物理上是在MySQL 进程内存中  
> 2、写到底盘（write） 但是没有持久化（fsync） 物理上是文件系统的page cache 里面  
> 3、持久化到磁盘 对应的是hard disk

日志写到redo log buffer 里是很快的，write 到page cache 也差不多 但是持久化到磁盘的速度就慢多了   

为了控制 redo log 的写入策略，InnoDB 提供了innodb_flush_log_at_trx_commit参数
>  0 表示每次事务提交时只是把redo log 留在redo log buffer中
>  1  表示每次事务提交时都将 redo log 直接持久化到磁盘；
>  2  表示每次事务提交时都只是把 redo log 写到 page cache。

InnoDB 有一个后台线程 每隔1s 就会把 redo log buffer 中的日志，，调用 write 写到文件系统的 page cache，然后调用 fsync 持久化到磁盘。

注意，事务执行中间过程的 redo log 也是直接写在 在 redo log buffer 中的，这些 redo log 也会被后台线程一起持久化到磁盘。也就是说，一个没有提交的事务的 redo log，也是可能已经持久化到磁盘  
  
实际上，除了后台线程每秒一次的轮询操作外，还有两种场景会让个没有提交的事务的 redo log 写入到磁盘中。

1、redo log buffer 占用的空间即将达到innodb_log_buffer_size 的一半的时候，后台的线程会主动写盘 。注意 由于事务并没有提交 所以这个写盘动作只是write 而没有调用fsync  也就是只留在了文件系统的page cache  
2、 并行的事务提交的额时候 顺带将这个事务的redo log buffer 持久化到磁盘  







 





