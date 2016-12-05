# csuoj
## laravel_version:5.3.3
# 部署
1.composer update
2.php artisan admin:install
3.php artisan migrate

# 使用
1.php artisan queue:work 判题端运行(可能需要到app/Jobs/judger和app/Jobs/cjudger中更改路径参数)
2.localhost/admin　进入管理员界面　默认账号密码admin
3.题目数据存放位置 public/Data/{题目编号}
4.数据格式 {something}.in~对应输入　{something}.out~对应输出
5.spj样例(a + b)
```c++
//file_name = spj.cpp 
#include <stdio.h>
 int main(int argc,char *args[]){
   FILE * f_in=fopen(args[1],"r");
   FILE * f_out=fopen(args[3],"r");
   FILE * f_user=fopen(args[2],"r");
   int ret=0;
   int a,b,c;
   while(fscanf(f_in,"%d %d",&a, &b) != EOF){
     fscanf(f_user,"%d",&c);
     if(a+b!=c) {
        ret=1;
        break;
     }
   }
   if(ret == 0) puts("WA");
   else puts("AC");
   fclose(f_in);
   fclose(f_out);
   fclose(f_user);
   return ret;
 }
 ```
 g++ spj.cpp -o spj.exe
 spj.cpp和spj.exe 存放位置 public/Data/{题目编号}
## 测试ip:107.174.247.79
