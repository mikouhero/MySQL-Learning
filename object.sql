/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50711
Source Host           : localhost:3306
Source Database       : object

Target Server Type    : MYSQL
Target Server Version : 50711
File Encoding         : 65001

Date: 2017-05-07 00:51:40
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for hc_user
-- ----------------------------
DROP TABLE IF EXISTS `hc_user`;
CREATE TABLE `hc_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `pass` char(32) NOT NULL,
  `sex` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `age` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `province` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hc_user
-- ----------------------------
INSERT INTO `hc_user` VALUES ('1', '黄超', 'e10adc3949ba59abbe56e057f20f883e', '1', '18', '江苏');
INSERT INTO `hc_user` VALUES ('2', '麦克雷', 'e10adc3949ba59abbe56e057f20f883e', '1', '40', '纽约');
INSERT INTO `hc_user` VALUES ('3', '卢西奥', 'e10adc3949ba59abbe56e057f20f883e', '0', '26', '纽约');
INSERT INTO `hc_user` VALUES ('4', '半藏', 'e10adc3949ba59abbe56e057f20f883e', '1', '38', '东京');
INSERT INTO `hc_user` VALUES ('5', '法老之鹰', 'e10adc3949ba59abbe56e057f20f883e', '0', '30', '江苏');
INSERT INTO `hc_user` VALUES ('6', '安娜', 'e10adc3949ba59abbe56e057f20f883e', '0', '80', '江苏');
INSERT INTO `hc_user` VALUES ('7', '天使', 'e10adc3949ba59abbe56e057f20f883e', '0', '30', '江苏');
INSERT INTO `hc_user` VALUES ('8', '查莉娅', 'e10adc3949ba59abbe56e057f20f883e', '0', '36', '浙江');
INSERT INTO `hc_user` VALUES ('9', '黑百合', 'e10adc3949ba59abbe56e057f20f883e', '0', '32', '上海');
INSERT INTO `hc_user` VALUES ('10', '猎空', 'e10adc3949ba59abbe56e057f20f883e', '0', '23', '北京');
INSERT INTO `hc_user` VALUES ('11', '狂鼠', 'e10adc3949ba59abbe56e057f20f883e', '1', '40', '新疆');
INSERT INTO `hc_user` VALUES ('12', '托比昂', 'e10adc3949ba59abbe56e057f20f883e', '1', '50', '新疆');
INSERT INTO `hc_user` VALUES ('13', 'D.Va', 'e10adc3949ba59abbe56e057f20f883e', '0', '20', '上海');
INSERT INTO `hc_user` VALUES ('14', '源氏', 'e10adc3949ba59abbe56e057f20f883e', '1', '35', '东京');
INSERT INTO `hc_user` VALUES ('15', '死神', 'e10adc3949ba59abbe56e057f20f883e', '1', '40', '纽约');
INSERT INTO `hc_user` VALUES ('16', '士兵76', 'e10adc3949ba59abbe56e057f20f883e', '1', '40', '纽约');
INSERT INTO `hc_user` VALUES ('17', '堡垒', 'e10adc3949ba59abbe56e057f20f883e', '1', '99', '纽约');
INSERT INTO `hc_user` VALUES ('18', '老王', 'e10adc3949ba59abbe56e057f20f883e', '2', '40', '隔壁的');
INSERT INTO `hc_user` VALUES ('19', '小美', 'e10adc3949ba59abbe56e057f20f883e', '0', '23', '北京');
INSERT INTO `hc_user` VALUES ('20', '莱因哈特', 'e10adc3949ba59abbe56e057f20f883e', '1', '80', '纽约');
INSERT INTO `hc_user` VALUES ('21', '路霸', 'e10adc3949ba59abbe56e057f20f883e', '1', '43', '上海');
INSERT INTO `hc_user` VALUES ('22', '温斯顿', 'e10adc3949ba59abbe56e057f20f883e', '2', '20', '上海');
INSERT INTO `hc_user` VALUES ('23', '秩序之光', 'e10adc3949ba59abbe56e057f20f883e', '0', '19', '上海');
INSERT INTO `hc_user` VALUES ('24', '小王', 'e10adc3949ba59abbe56e057f20f883e', '1', '40', '北京');
INSERT INTO `hc_user` VALUES ('25', '小王八', 'e10adc3949ba59abbe56e057f20f883e', '1', '4', '纽约');
INSERT INTO `hc_user` VALUES ('26', '小霸王', 'e10adc3949ba59abbe56e057f20f883e', '1', '4', '上海');
INSERT INTO `hc_user` VALUES ('27', '王尼玛', 'e10adc3949ba59abbe56e057f20f883e', '1', '40', '深圳');
INSERT INTO `hc_user` VALUES ('28', '王老五', 'e10adc3949ba59abbe56e057f20f883e', '0', '0', '江苏');
INSERT INTO `hc_user` VALUES ('29', '王麻子', 'e10adc3949ba59abbe56e057f20f883e', '0', '15', '四川');
INSERT INTO `hc_user` VALUES ('30', '王中王', 'e10adc3949ba59abbe56e057f20f883e', '1', '20', '贵州');
INSERT INTO `hc_user` VALUES ('31', '王守义', 'e10adc3949ba59abbe56e057f20f883e', '1', '11', '四川');
INSERT INTO `hc_user` VALUES ('32', '王老吉', 'e10adc3949ba59abbe56e057f20f883e', '2', '88', '江苏');
