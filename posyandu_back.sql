/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 50733
 Source Host           : localhost:3306
 Source Schema         : posyandu

 Target Server Type    : MySQL
 Target Server Version : 50733
 File Encoding         : 65001

 Date: 10/07/2022 09:31:41
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for bayi
-- ----------------------------
DROP TABLE IF EXISTS `bayi`;
CREATE TABLE `bayi`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pasien_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `nama_ibu` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama_ayah` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `posyandu_id` int(11) NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal_lahir` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `bb_pb` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `l_p` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `campak` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `meninggal` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `keterangan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `bayi`(`pasien_id`) USING BTREE,
  INDEX `posyandu_id`(`posyandu_id`) USING BTREE,
  CONSTRAINT `posyandu_id` FOREIGN KEY (`posyandu_id`) REFERENCES `list_posyandu` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 91 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bayi
-- ----------------------------
INSERT INTO `bayi` VALUES (84, NULL, 'Ramayana', 'Iyon', 1, 'Sisir', '2021-07-11', NULL, '1', NULL, NULL, NULL, '2021-07-12 08:40:18', '2021-07-12 16:20:13');
INSERT INTO `bayi` VALUES (85, NULL, 'Lisnawati', 'Zaenuri', 1, 'Ahmad Nasir', '2020-09-12', '-', '1', NULL, NULL, NULL, '2021-07-13 19:40:00', '2021-07-13 19:40:00');
INSERT INTO `bayi` VALUES (86, NULL, 'Kesusanti', 'Alimun Tasyah', 1, 'M Fahri Abdul Jamil', '2021-02-10', '3,4/51', '1', NULL, NULL, NULL, '2021-07-14 17:44:50', '2021-07-14 17:44:50');
INSERT INTO `bayi` VALUES (87, NULL, 'Adelia', 'Andika', 1, 'Wasilatul Rohmah', '2021-01-22', '2,8/48', '2', NULL, NULL, NULL, '2021-07-14 17:51:34', '2021-07-14 17:51:34');
INSERT INTO `bayi` VALUES (88, NULL, 'Siti Maisaroh', 'Pitrus', 1, 'Jinora', '2020-12-10', '2,6/50', '2', NULL, NULL, NULL, '2021-07-16 00:28:56', '2021-07-16 00:28:56');
INSERT INTO `bayi` VALUES (89, NULL, 'Halimatus', 'Bahri', 1, 'M Sauqi Abdul Halim', '2020-12-15', '3,8/50', '1', NULL, NULL, NULL, '2021-07-16 00:36:35', '2021-07-16 00:36:35');
INSERT INTO `bayi` VALUES (90, NULL, 'Lindawati', 'Haryanto', 2, 'Sefia Putri Ayu Lestari', '2020-09-24', '2', '2', NULL, NULL, NULL, '2021-07-16 01:29:13', '2022-07-06 18:28:05');

-- ----------------------------
-- Table structure for bbl
-- ----------------------------
DROP TABLE IF EXISTS `bbl`;
CREATE TABLE `bbl`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `umur` int(11) NOT NULL,
  `min3` float NOT NULL,
  `min2` float NOT NULL,
  `min1` float NOT NULL,
  `median` float NOT NULL,
  `plus1` float NOT NULL,
  `plus2` float NOT NULL,
  `plus3` float NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 62 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bbl
-- ----------------------------
INSERT INTO `bbl` VALUES (1, 0, 2.1, 2.5, 2.9, 3.3, 3.9, 4.4, 5, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (2, 1, 2.9, 3.4, 3.9, 4.5, 5.1, 5.8, 6.6, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (3, 2, 3.8, 4.3, 4.9, 5.6, 6.3, 7.1, 8, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (4, 3, 4.4, 5, 5.7, 6.4, 7.2, 8, 9, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (5, 4, 4.9, 5.6, 6.2, 7, 7.8, 8.7, 9.7, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (6, 5, 5.3, 6, 6.7, 7.5, 8.4, 9.3, 10.4, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (7, 6, 5.7, 6.4, 7.1, 7.9, 8.8, 9.8, 10.9, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (8, 7, 5.9, 6.7, 7.4, 8.3, 9.2, 10.3, 11.4, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (9, 8, 6.2, 6.9, 7.7, 8.6, 9.6, 10.7, 11.9, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (10, 9, 6.4, 7.1, 8, 8.9, 9.9, 11, 12.3, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (11, 10, 6.6, 7.4, 8.2, 9.2, 10.2, 11.4, 12.7, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (12, 11, 6.8, 7.6, 8.4, 9.4, 10.5, 11.7, 13, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (13, 12, 6.9, 7.7, 8.6, 9.6, 10.8, 12, 13.3, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (14, 13, 7.1, 7.9, 8.8, 9.9, 11, 12.3, 13.7, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (15, 14, 7.2, 8.1, 9, 10.1, 11.3, 12.6, 14, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (16, 15, 7.4, 8.3, 9.2, 10.3, 11.5, 12.8, 14.3, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (17, 16, 7.5, 8.4, 9.4, 10.5, 11.7, 13.1, 14.6, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (18, 17, 7.7, 8.6, 9.6, 10.7, 12, 13.4, 14.9, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (19, 18, 7.8, 8.8, 9.8, 10.9, 12.2, 13.7, 15.3, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (20, 19, 8, 8.9, 10, 11.1, 12.5, 13.9, 15.6, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (21, 20, 8.1, 9.1, 10.1, 11.3, 12.7, 14.2, 15.9, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (22, 21, 8.2, 9.2, 10.3, 11.5, 12.9, 14.5, 16.2, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (23, 22, 8.4, 9.4, 10.5, 11.8, 13.2, 14.7, 16.5, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (24, 23, 8.5, 9.5, 10.7, 12, 13.4, 15, 16.8, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (25, 24, 8.6, 9.7, 10.8, 12.2, 13.6, 15.3, 17.1, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (26, 25, 8.8, 9.8, 11, 12.4, 13.9, 15.5, 17.5, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (27, 26, 8.9, 10, 11.2, 12.5, 14.1, 15.8, 17.8, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (28, 27, 9, 10.1, 11.3, 12.7, 14.3, 16.1, 18.1, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (29, 28, 9.1, 10.2, 11.5, 12.9, 14.5, 16.3, 18.4, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (30, 29, 9.2, 10.4, 11.7, 13.1, 14.8, 16.6, 18.7, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (31, 30, 9.4, 10.5, 11.8, 13.3, 15, 16.9, 19, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (32, 31, 9.5, 10.7, 12, 13.5, 15.2, 17.1, 19.3, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (33, 32, 9.6, 10.8, 12.1, 13.7, 15.4, 17.4, 19.6, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (34, 33, 9.7, 10.9, 12.3, 13.8, 15.6, 17.6, 19.9, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (35, 34, 9.8, 11, 12.4, 14, 15.8, 17.8, 20.2, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (36, 35, 9.9, 11.2, 12.6, 14.2, 16, 18.1, 20.4, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (37, 36, 10, 11.3, 12.7, 14.3, 16.2, 18.3, 20.7, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (38, 37, 10.1, 11.4, 12.9, 14.5, 16.4, 18.6, 21, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (39, 38, 10.2, 11.5, 13, 14.7, 16.6, 18.8, 21.3, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (40, 39, 10.3, 11.6, 13.1, 14.8, 16.8, 19, 21.6, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (41, 40, 10.4, 11.8, 13.3, 15, 17, 19.3, 21.9, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (42, 41, 10.5, 11.9, 13.4, 15.2, 17.2, 19.5, 22.1, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (43, 42, 10.6, 12, 13.6, 15.3, 17.4, 19.7, 22.4, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (44, 43, 10.7, 12.1, 13.7, 15.5, 17.6, 20, 22.7, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (45, 44, 10.8, 12.2, 13.8, 15.7, 17.8, 20.2, 23, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (46, 45, 10.9, 12.4, 14, 15.8, 18, 20.5, 23.3, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (47, 46, 11, 12.5, 14.1, 16, 18.2, 20.7, 23.6, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (48, 47, 11.1, 12.6, 14.3, 16.2, 18.4, 20.9, 23.9, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (49, 48, 11.2, 12.7, 14.4, 16.3, 18.6, 21.2, 24.2, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (50, 49, 11.3, 12.8, 14.5, 16.5, 18.8, 21.4, 24.5, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (51, 50, 11.4, 12.9, 14.7, 16.7, 19, 21.7, 24.8, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (52, 51, 11.5, 13.1, 14.8, 16.8, 19.2, 21.9, 25.1, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (53, 52, 11.6, 13.2, 15, 17, 19.4, 22.2, 25.4, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (54, 53, 11.7, 13.3, 15.1, 17.2, 19.6, 22.4, 25.7, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (55, 54, 11.8, 13.4, 15.2, 17.3, 19.8, 22.7, 26, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (56, 55, 11.9, 13.5, 15.4, 17.5, 20, 22.9, 26.3, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (57, 56, 12, 13.6, 15.5, 17.7, 20.2, 23.2, 26.6, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (58, 57, 12.1, 13.7, 15.6, 17.8, 20.4, 23.4, 26.9, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (59, 58, 12.2, 13.8, 15.8, 18, 20.6, 23.7, 27.2, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (60, 59, 12.3, 14, 15.9, 18.2, 20.8, 23.9, 27.6, '2021-06-27 13:17:49', '2021-06-27 13:17:49');
INSERT INTO `bbl` VALUES (61, 60, 12.4, 14.1, 16, 18.3, 21, 24.2, 27.9, '2021-06-27 13:17:49', '2021-06-27 13:17:49');

-- ----------------------------
-- Table structure for bbp
-- ----------------------------
DROP TABLE IF EXISTS `bbp`;
CREATE TABLE `bbp`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `umur` int(11) NOT NULL,
  `min3` float NOT NULL,
  `min2` float NOT NULL,
  `min1` float NOT NULL,
  `median` float NOT NULL,
  `plus1` float NOT NULL,
  `plus2` float NOT NULL,
  `plus3` float NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 62 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bbp
-- ----------------------------
INSERT INTO `bbp` VALUES (1, 0, 2, 2.4, 2.8, 3.2, 3.7, 4.2, 4.8, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (2, 1, 2.7, 3.2, 3.6, 4.2, 4.8, 5.5, 6.2, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (3, 2, 3.4, 3.9, 4.5, 5.1, 5.8, 6.6, 7.5, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (4, 3, 4, 4.5, 5.2, 5.8, 6.6, 7.5, 8.5, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (5, 4, 4.4, 5, 5.7, 6.4, 7.3, 8.2, 9.3, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (6, 5, 4.8, 5.4, 6.1, 6.9, 7.8, 8.8, 10, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (7, 6, 5.1, 5.7, 6.5, 7.3, 8.2, 9.3, 10.6, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (8, 7, 5.3, 6, 6.8, 7.6, 8.6, 9.8, 11.1, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (9, 8, 5.6, 6.3, 7, 7.9, 9, 10.2, 11.6, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (10, 9, 5.8, 6.5, 7.3, 8.2, 9.3, 10.5, 12, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (11, 10, 5.9, 6.7, 7.5, 8.5, 9.6, 10.9, 12.4, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (12, 11, 6.1, 6.9, 7.7, 8.7, 9.9, 11.2, 12.8, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (13, 12, 6.3, 7, 7.9, 8.9, 10.1, 11.5, 13.1, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (14, 13, 6.4, 7.2, 8.1, 9.2, 10.4, 11.8, 13.5, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (15, 14, 6.6, 7.4, 8.3, 9.4, 10.6, 12.1, 13.8, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (16, 15, 6.7, 7.6, 8.5, 9.6, 10.9, 12.4, 14.1, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (17, 16, 6.9, 7.7, 8.7, 9.8, 11.1, 12.6, 14.5, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (18, 17, 7, 7.9, 8.9, 10, 11.4, 12.9, 14.8, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (19, 18, 7.2, 8.1, 9.1, 10.2, 11.6, 13.2, 15.1, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (20, 19, 7.3, 8.2, 9.2, 10.4, 11.8, 13.5, 15.4, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (21, 20, 7.5, 8.4, 9.4, 10.6, 12.1, 13.7, 15.7, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (22, 21, 7.6, 8.6, 9.6, 10.9, 12.3, 14, 16, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (23, 22, 7.8, 8.7, 9.8, 11.1, 12.5, 14.3, 16.4, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (24, 23, 7.9, 8.9, 10, 11.3, 12.8, 14.6, 16.7, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (25, 24, 8.1, 9, 10.2, 11.5, 13, 14.8, 17, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (26, 25, 8.2, 9.2, 10.3, 11.7, 13.3, 15.1, 17.3, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (27, 26, 8.4, 9.4, 10.5, 11.9, 13.5, 15.4, 17.7, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (28, 27, 8.5, 9.5, 10.7, 12.1, 13.7, 15.7, 18, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (29, 28, 8.6, 9.7, 10.9, 12.3, 14, 16, 18.3, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (30, 29, 8.8, 9.8, 11.1, 12.5, 14.2, 16.2, 18.7, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (31, 30, 8.9, 10, 11.2, 12.7, 14.4, 16.5, 19, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (32, 31, 9, 10.1, 11.4, 12.9, 14.7, 16.8, 19.3, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (33, 32, 9.1, 10.3, 11.6, 13.1, 14.9, 17.1, 19.6, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (34, 33, 9.3, 10.4, 11.7, 13.3, 15.1, 17.3, 20, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (35, 34, 9.4, 10.5, 11.9, 13.5, 15.4, 17.6, 20.3, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (36, 35, 9.5, 10.7, 12, 13.7, 15.6, 17.9, 20.6, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (37, 36, 9.6, 10.8, 12.2, 13.9, 15.8, 18.1, 20.9, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (38, 37, 9.7, 10.9, 12.4, 14, 16, 18.4, 21.3, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (39, 38, 9.8, 11.1, 12.5, 14.2, 16.3, 18.7, 21.6, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (40, 39, 9.9, 11.2, 12.7, 14.4, 16.5, 19, 22, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (41, 40, 10.1, 11.3, 12.8, 14.6, 16.7, 19.2, 22.3, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (42, 41, 10.2, 11.5, 13, 14.8, 16.9, 19.5, 22.7, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (43, 42, 10.3, 11.6, 13.1, 15, 17.2, 19.8, 23, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (44, 43, 10.4, 11.7, 13.3, 15.2, 17.4, 20.1, 23.4, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (45, 44, 10.5, 11.8, 13.4, 15.3, 17.6, 20.4, 23.7, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (46, 45, 10.6, 12, 13.6, 15.5, 17.8, 20.7, 24.1, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (47, 46, 10.7, 12.1, 13.7, 15.7, 18.1, 20.9, 24.5, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (48, 47, 10.8, 12.2, 13.9, 15.9, 18.3, 21.2, 24.8, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (49, 48, 10.9, 12.3, 14, 16.1, 18.5, 21.5, 25.2, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (50, 49, 11, 12.4, 14.2, 16.3, 18.8, 21.8, 25.5, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (51, 50, 11.1, 12.6, 14.3, 16.4, 19, 22.1, 25.9, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (52, 51, 11.2, 12.7, 14.5, 16.6, 19.2, 22.4, 26.3, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (53, 52, 11.3, 12.8, 14.6, 16.8, 19.4, 22.6, 26.6, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (54, 53, 11.4, 12.9, 14.8, 17, 19.7, 22.9, 27, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (55, 54, 11.5, 13, 14.9, 17.2, 19.9, 23.2, 27.4, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (56, 55, 11.6, 13.2, 15.1, 17.3, 20.1, 23.5, 27.7, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (57, 56, 11.7, 13.3, 15.2, 17.5, 20.3, 23.8, 28.1, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (58, 57, 11.8, 13.4, 15.3, 17.7, 20.6, 24.1, 28.5, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (59, 58, 11.9, 13.5, 15.5, 17.9, 20.8, 24.4, 28.8, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (60, 59, 12, 13.6, 15.6, 18, 21, 24.6, 29.2, '2021-06-27 14:04:51', '2021-06-27 14:04:51');
INSERT INTO `bbp` VALUES (61, 60, 12.1, 13.7, 15.8, 18.2, 21.2, 24.9, 29.5, '2021-06-27 14:04:51', '2021-06-27 14:04:51');

-- ----------------------------
-- Table structure for bumils
-- ----------------------------
DROP TABLE IF EXISTS `bumils`;
CREATE TABLE `bumils`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pasien_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `posyandu_id` int(11) NOT NULL,
  `nama_ibu` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `nama_suami` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `umur` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `klp_dasa_wisma` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `tanggal` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `umur_kelahiran` int(11) NULL DEFAULT NULL,
  `hamil_ke` int(11) NULL DEFAULT NULL,
  `lila` int(11) NULL DEFAULT NULL,
  `pmt_pemulihan` int(1) NULL DEFAULT NULL,
  `kapsul_yodium` int(1) NULL DEFAULT NULL,
  `resiko` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `bayi` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `bayi_meninggal` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `persalinan` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `tanggal_persalinan` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `ibu_meninggal` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `keterangan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `bumils_pasien_id_foreign`(`pasien_id`) USING BTREE,
  INDEX `bumil_list_posyandu`(`posyandu_id`) USING BTREE,
  CONSTRAINT `bumil_list_posyandu` FOREIGN KEY (`posyandu_id`) REFERENCES `list_posyandu` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `bumils_pasien_id_foreign` FOREIGN KEY (`pasien_id`) REFERENCES `pasiens` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 68 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bumils
-- ----------------------------
INSERT INTO `bumils` VALUES (53, NULL, 1, 'Ramayana', 'Romayao', '34', NULL, '2016-02-12', 2, 2, 24, NULL, NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, '2021-07-12 08:34:28', '2022-07-09 10:06:36');
INSERT INTO `bumils` VALUES (57, NULL, 6, 'Sumasia', 'Hartoyi', '23', NULL, '2022-07-09', 2, 2, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-12 15:30:42', '2022-07-09 10:06:55');
INSERT INTO `bumils` VALUES (58, NULL, 1, 'Sumimi', 'Wahyu', '30', NULL, '2021-02-23', 8, 2, 28, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-13 16:01:12', '2021-07-13 16:01:12');
INSERT INTO `bumils` VALUES (59, NULL, 1, 'Emi Vera Wati', 'Ahmad Sidik', '23', NULL, '2021-04-10', 6, 2, 26, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-13 17:41:29', '2021-07-13 17:41:29');
INSERT INTO `bumils` VALUES (60, NULL, 1, 'Babun Rizki', 'Toriman', '25', NULL, '2021-05-06', 13, 3, 24, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-13 17:49:38', '2021-07-13 17:49:38');
INSERT INTO `bumils` VALUES (61, NULL, 1, 'Sindi Antika', 'Ali Hendrik', '26', NULL, '2021-04-22', 10, 2, 27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-13 17:53:28', '2021-07-13 17:53:28');
INSERT INTO `bumils` VALUES (62, NULL, 1, 'Ilmiyatul M', 'Ahsani', '21', NULL, '2021-12-13', 7, 1, 23, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-13 18:02:09', '2021-07-13 18:02:09');
INSERT INTO `bumils` VALUES (63, NULL, 1, 'Riska Rizki Ana Sari', 'Sofi', '28', NULL, '2020-12-07', 7, 3, 20, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-13 18:12:33', '2021-07-13 18:12:33');
INSERT INTO `bumils` VALUES (64, NULL, 1, 'Jumani', 'Sumardi', '34', NULL, '2020-12-16', 12, 3, 28, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-13 18:37:08', '2021-07-13 18:37:08');
INSERT INTO `bumils` VALUES (65, NULL, 1, 'Hayati', 'Rudianto', '42', NULL, '2021-03-13', 7, 5, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-13 18:46:29', '2021-07-13 18:46:29');
INSERT INTO `bumils` VALUES (66, NULL, 1, 'Alifatul Nafifah', '-', '0', NULL, '2020-12-14', 5, 1, 24, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-13 19:01:45', '2021-07-13 19:01:45');
INSERT INTO `bumils` VALUES (67, NULL, 1, 'Ratna Wati', 'Syaiful', '24', NULL, '2020-12-01', 13, 2, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-13 19:22:35', '2021-07-13 19:22:35');

-- ----------------------------
-- Table structure for detail_bayi_imun
-- ----------------------------
DROP TABLE IF EXISTS `detail_bayi_imun`;
CREATE TABLE `detail_bayi_imun`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bayi_id` bigint(20) UNSIGNED NOT NULL,
  `hbo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `bcg` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `dpt_hb` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `polio` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `detail_bayi_imun`(`bayi_id`) USING BTREE,
  CONSTRAINT `detail_bayi_imun` FOREIGN KEY (`bayi_id`) REFERENCES `bayi` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 60 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detail_bayi_imun
-- ----------------------------
INSERT INTO `detail_bayi_imun` VALUES (37, 85, '[{\"tahun_ke\":\"1\",\"tanggal\":\"2020-09-12\"}]', '[{\"tahun_ke\":\"1\",\"tanggal\":\"2020-10-12\"}]', '[]', '[{\"tahun_ke\":\"1\",\"bulan_ke_1\":\"2021-10-12\",\"bulan_ke_2\":\"2021-11-12\",\"bulan_ke_3\":\"2021-01-14\"}]', '2021-07-16 00:37:17', '2021-07-16 00:37:17');
INSERT INTO `detail_bayi_imun` VALUES (38, 86, '[]', '[{\"tahun_ke\":\"1\",\"tanggal\":\"2021-03-10\"}]', '[]', '[{\"tahun_ke\":\"1\",\"bulan_ke_1\":\"2021-03-10\",\"bulan_ke_2\":null,\"bulan_ke_3\":null}]', '2021-07-16 00:38:19', '2021-07-16 00:38:19');
INSERT INTO `detail_bayi_imun` VALUES (39, 87, '[{\"tahun_ke\":\"1\",\"tanggal\":\"2021-01-22\"}]', '[{\"tahun_ke\":\"1\",\"tanggal\":\"2021-02-10\"}]', '[]', '[{\"tahun_ke\":\"1\",\"bulan_ke_1\":\"2021-02-10\",\"bulan_ke_2\":null,\"bulan_ke_3\":null}]', '2021-07-16 00:39:46', '2021-07-16 00:39:46');
INSERT INTO `detail_bayi_imun` VALUES (40, 88, '[{\"tahun_ke\":\"1\",\"tanggal\":\"2020-12-10\"}]', '[{\"tahun_ke\":\"1\",\"tanggal\":\"2021-01-14\"}]', '[]', '[{\"tahun_ke\":\"1\",\"bulan_ke_1\":\"2020-12-14\",\"bulan_ke_2\":\"2021-01-14\",\"bulan_ke_3\":null}]', '2021-07-16 00:40:25', '2021-07-16 00:40:25');
INSERT INTO `detail_bayi_imun` VALUES (47, 89, '[{\"tahun_ke\":\"1\",\"tanggal\":\"2020-12-15\"}]', '[{\"tahun_ke\":\"1\",\"tanggal\":\"2021-01-14\"}]', '[]', '[{\"tahun_ke\":\"1\",\"bulan_ke_1\":\"2021-01-14\",\"bulan_ke_2\":\"2021-03-14\",\"bulan_ke_3\":null}]', '2021-07-16 01:24:05', '2021-07-16 01:24:05');
INSERT INTO `detail_bayi_imun` VALUES (48, 84, '[]', '[]', '[]', '[{\"tahun_ke\":\"1\",\"bulan_ke_1\":\"2021-07-01\",\"bulan_ke_2\":\"2021-07-02\",\"bulan_ke_3\":\"2021-07-04\"}]', '2021-07-16 01:24:06', '2021-07-16 01:24:06');
INSERT INTO `detail_bayi_imun` VALUES (59, 90, '[{\"tahun_ke\":\"1\",\"tanggal\":\"2020-09-12\"}]', '[{\"tahun_ke\":\"1\",\"tanggal\":\"2020-10-12\"}]', '[]', '[{\"tahun_ke\":\"1\",\"bulan_ke_1\":\"2020-12-14\",\"bulan_ke_2\":null,\"bulan_ke_3\":null,\"bulan_ke_4\":null}]', '2022-07-06 18:28:05', '2022-07-06 18:28:05');

-- ----------------------------
-- Table structure for detail_bayi_obat
-- ----------------------------
DROP TABLE IF EXISTS `detail_bayi_obat`;
CREATE TABLE `detail_bayi_obat`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bayi_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `sirup_fe` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `vit_a` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `oralit` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `detail_bayi_obat`(`bayi_id`) USING BTREE,
  CONSTRAINT `detail_bayi_obat` FOREIGN KEY (`bayi_id`) REFERENCES `bayi` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detail_bayi_obat
-- ----------------------------

-- ----------------------------
-- Table structure for detail_bayi_timbang
-- ----------------------------
DROP TABLE IF EXISTS `detail_bayi_timbang`;
CREATE TABLE `detail_bayi_timbang`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bayi_id` bigint(20) UNSIGNED NOT NULL,
  `bulan_ke` int(11) NOT NULL,
  `bulan` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `umur_bulan` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `umur_hari` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `berat_badan` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tinggi_badan` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `sd_bb` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `sd_pb` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status_bb` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status_pb` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `detail_bayi_timbang`(`bayi_id`) USING BTREE,
  CONSTRAINT `detail_bayi_timbang` FOREIGN KEY (`bayi_id`) REFERENCES `bayi` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 275 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detail_bayi_timbang
-- ----------------------------
INSERT INTO `detail_bayi_timbang` VALUES (173, 85, 1, 'Oktober', '1', '1', '4.1', '65', '-1', '+3', 'Berat badan normal', 'Tinggi', '2020-10-13', '2021-07-16 00:37:17', '2021-07-16 00:37:17');
INSERT INTO `detail_bayi_timbang` VALUES (174, 86, 1, 'Maret', '1', '4', '4.5', '51', 'median', '-2', 'Berat badan normal', 'Normal', '2021-03-14', '2021-07-16 00:38:19', '2021-07-16 00:38:19');
INSERT INTO `detail_bayi_timbang` VALUES (175, 86, 2, 'April', '2', '4', '4.9', '51', '-1', '-3', 'Berat badan normal', 'Sangat pendek (severely stunted)', '2021-04-14', '2021-07-16 00:38:19', '2021-07-16 00:38:19');
INSERT INTO `detail_bayi_timbang` VALUES (176, 86, 3, 'Mei', '3', '4', '6', '63', '-1', '+1', 'Berat badan normal', 'Normal', '2021-05-14', '2021-07-16 00:38:19', '2021-07-16 00:38:19');
INSERT INTO `detail_bayi_timbang` VALUES (177, 86, 4, 'Juni', '4', '4', '6.6', '63', '-1', 'median', 'Berat badan normal', 'Normal', '2021-06-14', '2021-07-16 00:38:19', '2021-07-16 00:38:19');
INSERT INTO `detail_bayi_timbang` VALUES (178, 87, 1, 'Februari', '1', '22', '3.6', '50', '-1', '-2', 'Berat badan normal', 'Normal', '2021-02-14', '2021-07-16 00:39:46', '2021-07-16 00:39:46');
INSERT INTO `detail_bayi_timbang` VALUES (179, 87, 2, 'Maret', '2', '22', '5.1', '50', 'median', '-3', 'Berat badan normal', 'Sangat pendek (severely stunted)', '2021-03-14', '2021-07-16 00:39:46', '2021-07-16 00:39:46');
INSERT INTO `detail_bayi_timbang` VALUES (180, 87, 3, 'April', '3', '22', '6.1', '50', 'median', '-3', 'Berat badan normal', 'Sangat pendek (severely stunted)', '2021-04-14', '2021-07-16 00:39:46', '2021-07-16 00:39:46');
INSERT INTO `detail_bayi_timbang` VALUES (181, 87, 4, 'Mei', '4', '22', '6.3', '60', 'median', '-1', 'Berat badan normal', 'Normal', '2021-05-14', '2021-07-16 00:39:46', '2021-07-16 00:39:46');
INSERT INTO `detail_bayi_timbang` VALUES (182, 87, 5, 'Juni', '5', '22', '7.2', '60', 'median', '-2', 'Berat badan normal', 'Normal', '2021-06-14', '2021-07-16 00:39:46', '2021-07-16 00:39:46');
INSERT INTO `detail_bayi_timbang` VALUES (183, 88, 1, 'Januari', '1', '5', '3.6', '54', '-1', 'median', 'Berat badan normal', 'Normal', '2021-01-15', '2021-07-16 00:40:25', '2021-07-16 00:40:25');
INSERT INTO `detail_bayi_timbang` VALUES (184, 88, 2, 'Februari', '2', '5', '4.6', '54', '-1', '-2', 'Berat badan normal', 'Normal', '2021-02-15', '2021-07-16 00:40:25', '2021-07-16 00:40:25');
INSERT INTO `detail_bayi_timbang` VALUES (185, 88, 3, 'Maret', '3', '5', '4.7', '54', '-2', '-3', 'Berat badan normal', 'Pendek (stunted)', '2021-03-15', '2021-07-16 00:40:25', '2021-07-16 00:40:25');
INSERT INTO `detail_bayi_timbang` VALUES (186, 88, 4, 'April', '4', '5', '6.5', '54', 'median', '-3', 'Berat badan normal', 'Sangat pendek (severely stunted)', '2021-04-15', '2021-07-16 00:40:25', '2021-07-16 00:40:25');
INSERT INTO `detail_bayi_timbang` VALUES (208, 89, 1, 'Januari', '1', '0', '4', '50', '-1', '-2', 'Berat badan normal', 'Pendek (stunted)', '2021-01-15', '2021-07-16 01:24:05', '2021-07-16 01:24:05');
INSERT INTO `detail_bayi_timbang` VALUES (209, 89, 2, 'Februari', '2', '0', '4.8', '56', '-1', '-1', 'Berat badan normal', 'Normal', '2021-02-15', '2021-07-16 01:24:05', '2021-07-16 01:24:05');
INSERT INTO `detail_bayi_timbang` VALUES (210, 89, 3, 'Maret', '3', '0', '6.2', '56', 'median', '-3', 'Berat badan normal', 'Pendek (stunted)', '2021-03-15', '2021-07-16 01:24:05', '2021-07-16 01:24:05');
INSERT INTO `detail_bayi_timbang` VALUES (211, 89, 4, 'April', '4', '0', '7', '56', 'median', '-3', 'Berat badan normal', 'Sangat pendek (severely stunted)', '2021-04-15', '2021-07-16 01:24:05', '2021-07-16 01:24:05');
INSERT INTO `detail_bayi_timbang` VALUES (212, 89, 5, 'Mei', '5', '0', '8', '64', '+1', '-1', 'Berat badan normal', 'Normal', '2021-05-15', '2021-07-16 01:24:05', '2021-07-16 01:24:05');
INSERT INTO `detail_bayi_timbang` VALUES (213, 89, 6, 'Juni', '6', '0', '8.3', '64', 'median', '-2', 'Berat badan normal', 'Normal', '2021-06-15', '2021-07-16 01:24:05', '2021-07-16 01:24:05');
INSERT INTO `detail_bayi_timbang` VALUES (214, 84, 1, 'Januari', '0', '1', '5', '45', '+3', '-3', 'Risiko Berat badan lebih', 'Pendek (stunted)', '2021-07-12', '2021-07-16 01:24:06', '2021-07-16 01:24:06');
INSERT INTO `detail_bayi_timbang` VALUES (266, 90, 1, 'Oktober', '1', '21', '2.5', '59', '-3', '+3', 'Berat badan sangat kurang (severely underweight)', 'Tinggi', '2020-10-15', '2022-07-06 18:28:05', '2022-07-06 18:28:05');
INSERT INTO `detail_bayi_timbang` VALUES (267, 90, 2, 'November', '2', '21', '2.9', '59', '-3', '+1', 'Berat badan sangat kurang (severely underweight)', 'Normal', '2020-11-15', '2022-07-06 18:28:05', '2022-07-06 18:28:05');
INSERT INTO `detail_bayi_timbang` VALUES (268, 90, 3, 'Desember', '3', '21', '3', '59', '-3', 'median', 'Berat badan sangat kurang (severely underweight)', 'Normal', '2020-12-15', '2022-07-06 18:28:05', '2022-07-06 18:28:05');
INSERT INTO `detail_bayi_timbang` VALUES (269, 90, 4, 'Januari', '4', '21', '4', '59', '-3', '-1', 'Berat badan sangat kurang (severely underweight)', 'Normal', '2021-01-15', '2022-07-06 18:28:05', '2022-07-06 18:28:05');
INSERT INTO `detail_bayi_timbang` VALUES (270, 90, 5, 'Februari', '5', '21', '4.8', '59', '-3', '-2', 'Berat badan kurang (underweight)', 'Pendek (stunted)', '2021-02-15', '2022-07-06 18:28:05', '2022-07-06 18:28:05');
INSERT INTO `detail_bayi_timbang` VALUES (271, 90, 6, 'Maret', '6', '21', '5.8', '59', '-2', '-3', 'Berat badan normal', 'Pendek (stunted)', '2021-03-15', '2022-07-06 18:28:05', '2022-07-06 18:28:05');
INSERT INTO `detail_bayi_timbang` VALUES (272, 90, 7, 'April', '7', '21', '5.8', '59', '-2', '-3', 'Berat badan kurang (underweight)', 'Sangat pendek (severely stunted)', '2021-04-15', '2022-07-06 18:28:05', '2022-07-06 18:28:05');
INSERT INTO `detail_bayi_timbang` VALUES (273, 90, 8, 'Mei', '8', '21', '5.9', '59', '-3', '-3', 'Berat badan kurang (underweight)', 'Sangat pendek (severely stunted)', '2021-05-15', '2022-07-06 18:28:05', '2022-07-06 18:28:05');
INSERT INTO `detail_bayi_timbang` VALUES (274, 90, 9, 'Juni', '9', '21', '6.3', '59', '-2', '-3', 'Berat badan kurang (underweight)', 'Sangat pendek (severely stunted)', '2021-06-15', '2022-07-06 18:28:05', '2022-07-06 18:28:05');

-- ----------------------------
-- Table structure for detail_bumils_hasil_penimbangan
-- ----------------------------
DROP TABLE IF EXISTS `detail_bumils_hasil_penimbangan`;
CREATE TABLE `detail_bumils_hasil_penimbangan`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `bumils_id` bigint(20) UNSIGNED NOT NULL,
  `bulan_ke` int(11) NOT NULL,
  `bulan` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `berat_badan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tekanan_darah` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `detail_hasil_penimbangan`(`bumils_id`) USING BTREE,
  CONSTRAINT `detail_hasil_penimbangan` FOREIGN KEY (`bumils_id`) REFERENCES `bumils` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 137 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detail_bumils_hasil_penimbangan
-- ----------------------------
INSERT INTO `detail_bumils_hasil_penimbangan` VALUES (45, 58, 1, 'April', '64', '90/60', '2021-04-05', '2021-07-13 16:05:25', '2021-07-13 16:05:25');
INSERT INTO `detail_bumils_hasil_penimbangan` VALUES (46, 58, 2, 'Mei', '67', '100/60', '2021-05-05', '2021-07-13 16:05:25', '2021-07-13 16:05:25');
INSERT INTO `detail_bumils_hasil_penimbangan` VALUES (47, 58, 3, 'Juni', '67', '99/70', '2021-05-06', '2021-07-13 16:05:25', '2021-07-13 16:05:25');
INSERT INTO `detail_bumils_hasil_penimbangan` VALUES (52, 59, 1, 'April', '65', '90/60', '2021-04-05', '2021-07-13 17:44:39', '2021-07-13 17:44:39');
INSERT INTO `detail_bumils_hasil_penimbangan` VALUES (53, 59, 2, 'Mei', '66', '109/77', '2021-05-04', '2021-07-13 17:44:39', '2021-07-13 17:44:39');
INSERT INTO `detail_bumils_hasil_penimbangan` VALUES (54, 59, 3, 'Juni', '65', '97/67', '2021-06-05', '2021-07-13 17:44:39', '2021-07-13 17:44:39');
INSERT INTO `detail_bumils_hasil_penimbangan` VALUES (55, 60, 1, 'Mei', '55', '110/70', '2021-05-05', '2021-07-13 17:49:38', '2021-07-13 17:49:38');
INSERT INTO `detail_bumils_hasil_penimbangan` VALUES (59, 61, 1, 'April', '53', '110/70', '2021-04-05', '2021-07-13 17:55:23', '2021-07-13 17:55:23');
INSERT INTO `detail_bumils_hasil_penimbangan` VALUES (60, 61, 2, 'Mei', '56', '110/70', '2021-05-05', '2021-07-13 17:55:23', '2021-07-13 17:55:23');
INSERT INTO `detail_bumils_hasil_penimbangan` VALUES (61, 61, 3, 'Juni', '57', '121/71', '2021-06-05', '2021-07-13 17:55:23', '2021-07-13 17:55:23');
INSERT INTO `detail_bumils_hasil_penimbangan` VALUES (64, 62, 1, 'Januari', '42', '106/78', '2021-12-05', '2021-07-13 18:07:41', '2021-07-13 18:07:41');
INSERT INTO `detail_bumils_hasil_penimbangan` VALUES (65, 62, 2, 'Februari', '41', '90/60', '2021-02-05', '2021-07-13 18:07:41', '2021-07-13 18:07:41');
INSERT INTO `detail_bumils_hasil_penimbangan` VALUES (74, 63, 1, 'Desember', '34', '100/60', '2020-12-05', '2021-07-13 18:33:35', '2021-07-13 18:33:35');
INSERT INTO `detail_bumils_hasil_penimbangan` VALUES (75, 63, 2, 'Februari', '35', '90/60', '2021-02-05', '2021-07-13 18:33:35', '2021-07-13 18:33:35');
INSERT INTO `detail_bumils_hasil_penimbangan` VALUES (76, 63, 3, 'Maret', '36', '90/70', '2021-03-05', '2021-07-13 18:33:35', '2021-07-13 18:33:35');
INSERT INTO `detail_bumils_hasil_penimbangan` VALUES (77, 63, 4, 'April', '38', '110/70', '2021-04-05', '2021-07-13 18:33:35', '2021-07-13 18:33:35');
INSERT INTO `detail_bumils_hasil_penimbangan` VALUES (99, 64, 1, 'Desember', '56', '100/60', '2020-12-05', '2021-07-13 18:44:39', '2021-07-13 18:44:39');
INSERT INTO `detail_bumils_hasil_penimbangan` VALUES (100, 64, 2, 'Januari', '56', '120/80', '2021-01-05', '2021-07-13 18:44:39', '2021-07-13 18:44:39');
INSERT INTO `detail_bumils_hasil_penimbangan` VALUES (101, 64, 3, 'Februari', '58', '120/70', '2021-02-05', '2021-07-13 18:44:39', '2021-07-13 18:44:39');
INSERT INTO `detail_bumils_hasil_penimbangan` VALUES (102, 64, 4, 'Maret', '56', '117/75', '2021-03-05', '2021-07-13 18:44:39', '2021-07-13 18:44:39');
INSERT INTO `detail_bumils_hasil_penimbangan` VALUES (103, 64, 5, 'April', '58', '110/70', '2021-04-05', '2021-07-13 18:44:39', '2021-07-13 18:44:39');
INSERT INTO `detail_bumils_hasil_penimbangan` VALUES (104, 64, 6, 'Mei', '56', '117/75', '2021-05-05', '2021-07-13 18:44:39', '2021-07-13 18:44:39');
INSERT INTO `detail_bumils_hasil_penimbangan` VALUES (105, 64, 7, 'Juni', '59', '123/73', '2021-06-05', '2021-07-13 18:44:39', '2021-07-13 18:44:39');
INSERT INTO `detail_bumils_hasil_penimbangan` VALUES (112, 65, 1, 'Maret', '60', '100/80', '2021-03-05', '2021-07-13 18:59:23', '2021-07-13 18:59:23');
INSERT INTO `detail_bumils_hasil_penimbangan` VALUES (113, 65, 2, 'April', '56', '110/70', '2021-04-05', '2021-07-13 18:59:23', '2021-07-13 18:59:23');
INSERT INTO `detail_bumils_hasil_penimbangan` VALUES (114, 65, 3, 'Mei', '55', '110/70', '2021-05-05', '2021-07-13 18:59:23', '2021-07-13 18:59:23');
INSERT INTO `detail_bumils_hasil_penimbangan` VALUES (115, 65, 4, 'Juni', '59', '110/70', '2021-06-05', '2021-07-13 18:59:23', '2021-07-13 18:59:23');
INSERT INTO `detail_bumils_hasil_penimbangan` VALUES (122, 66, 1, 'Desember', '45', '100/70', '2020-12-05', '2021-07-13 19:04:09', '2021-07-13 19:04:09');
INSERT INTO `detail_bumils_hasil_penimbangan` VALUES (123, 66, 2, 'Januari', '46', '100/70', '2021-01-05', '2021-07-13 19:04:09', '2021-07-13 19:04:09');
INSERT INTO `detail_bumils_hasil_penimbangan` VALUES (124, 66, 3, 'Februari', '46', '120/90', '2021-02-05', '2021-07-13 19:04:09', '2021-07-13 19:04:09');
INSERT INTO `detail_bumils_hasil_penimbangan` VALUES (125, 66, 4, 'Mei', '52', '115/70', '2021-05-05', '2021-07-13 19:04:09', '2021-07-13 19:04:09');
INSERT INTO `detail_bumils_hasil_penimbangan` VALUES (132, 67, 1, 'Desember', '46', '120/80', '2020-12-05', '2021-07-13 19:25:57', '2021-07-13 19:25:57');
INSERT INTO `detail_bumils_hasil_penimbangan` VALUES (133, 67, 2, 'Januari', '46', '130/90', '2021-01-05', '2021-07-13 19:25:57', '2021-07-13 19:25:57');
INSERT INTO `detail_bumils_hasil_penimbangan` VALUES (134, 67, 3, 'Februari', '47', '129/81', '2021-02-05', '2021-07-13 19:25:57', '2021-07-13 19:25:57');
INSERT INTO `detail_bumils_hasil_penimbangan` VALUES (135, 67, 4, 'Maret', '50', '120/80', '2021-03-05', '2021-07-13 19:25:57', '2021-07-13 19:25:57');
INSERT INTO `detail_bumils_hasil_penimbangan` VALUES (136, 57, 1, 'Januari', '23', '22/2', '2021-07-12', '2022-07-09 10:06:55', '2022-07-09 10:06:55');

-- ----------------------------
-- Table structure for detail_bumils_imunisasi_tt
-- ----------------------------
DROP TABLE IF EXISTS `detail_bumils_imunisasi_tt`;
CREATE TABLE `detail_bumils_imunisasi_tt`  (
  `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `bumils_id` bigint(20) UNSIGNED NOT NULL,
  `status` int(1) NOT NULL,
  `tanggal` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `detail_imunisasi_tt`(`bumils_id`) USING BTREE,
  CONSTRAINT `detail_imunisasi_tt` FOREIGN KEY (`bumils_id`) REFERENCES `bumils` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detail_bumils_imunisasi_tt
-- ----------------------------

-- ----------------------------
-- Table structure for detail_bumils_tablet_tambah_darah
-- ----------------------------
DROP TABLE IF EXISTS `detail_bumils_tablet_tambah_darah`;
CREATE TABLE `detail_bumils_tablet_tambah_darah`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `bumils_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `status` int(1) NOT NULL,
  `tanggal` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `detail_tablet_tambah_darah`(`bumils_id`) USING BTREE,
  CONSTRAINT `detail_tablet_tambah_darah` FOREIGN KEY (`bumils_id`) REFERENCES `bumils` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detail_bumils_tablet_tambah_darah
-- ----------------------------

-- ----------------------------
-- Table structure for kader
-- ----------------------------
DROP TABLE IF EXISTS `kader`;
CREATE TABLE `kader`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `posyandu_id` int(11) NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` int(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `kader_users_id`(`users_id`) USING BTREE,
  INDEX `kader_posyandu_id`(`posyandu_id`) USING BTREE,
  CONSTRAINT `kader_posyandu_id` FOREIGN KEY (`posyandu_id`) REFERENCES `list_posyandu` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `kader_users_id` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kader
-- ----------------------------
INSERT INTO `kader` VALUES (15, '8719327198273917', 1, 21, 1, '2021-06-18 17:49:18', '2021-06-18 20:35:30');
INSERT INTO `kader` VALUES (20, '9871209381083091', 1, 60, 1, '2022-07-02 12:22:55', '2022-07-02 12:23:26');

-- ----------------------------
-- Table structure for list_posyandu
-- ----------------------------
DROP TABLE IF EXISTS `list_posyandu`;
CREATE TABLE `list_posyandu`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of list_posyandu
-- ----------------------------
INSERT INTO `list_posyandu` VALUES (1, 'Posyandu Manggis 18', NULL, NULL);
INSERT INTO `list_posyandu` VALUES (2, 'Posyandu Manggis 19', NULL, NULL);
INSERT INTO `list_posyandu` VALUES (6, 'Posyandu Manggis 20', '2021-07-09 13:37:39', '2021-07-09 13:37:39');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2020_09_11_052235_create_pasiens_table', 1);
INSERT INTO `migrations` VALUES (4, '2020_09_11_052624_create_pengantins_table', 1);
INSERT INTO `migrations` VALUES (5, '2020_09_11_052803_create_bumils_table', 1);

-- ----------------------------
-- Table structure for pasiens
-- ----------------------------
DROP TABLE IF EXISTS `pasiens`;
CREATE TABLE `pasiens`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `posyandu_id` int(11) NOT NULL,
  `users_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `nik` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `tempat_lahir` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `tgl_lahir` date NULL DEFAULT NULL,
  `umur` double NULL DEFAULT NULL,
  `pekerjaan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `pekerjaan_lainnya` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `pendidikan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `nama_suami` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `nik_suami` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `umur_suami` double NULL DEFAULT NULL,
  `pekerjaan_suami` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `pekerjaan_suami_lainnya` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `pendidikan_suami` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `alamat` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `alamat_domisili` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `rw` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `kecamatan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `kabupaten` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `kota` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `no_tlp` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `pasiens_users_id`(`users_id`) USING BTREE,
  INDEX `pasiens_posyandu_id`(`posyandu_id`) USING BTREE,
  CONSTRAINT `pasiens_posyandu_id` FOREIGN KEY (`posyandu_id`) REFERENCES `list_posyandu` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `pasiens_users_id` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pasiens
-- ----------------------------

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for pbl
-- ----------------------------
DROP TABLE IF EXISTS `pbl`;
CREATE TABLE `pbl`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `umur` int(11) NOT NULL,
  `min3` float NOT NULL,
  `min2` float NOT NULL,
  `min1` float NOT NULL,
  `median` float NOT NULL,
  `plus1` float NOT NULL,
  `plus2` float NOT NULL,
  `plus3` float NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 63 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pbl
-- ----------------------------
INSERT INTO `pbl` VALUES (1, 0, 44.2, 46.1, 48, 49.9, 51.8, 53.7, 55.6, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (2, 1, 48.9, 50.8, 52.8, 54.7, 56.7, 58.6, 60.6, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (3, 2, 52.4, 54.4, 56.4, 58.4, 60.4, 62.4, 64.4, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (4, 3, 55.3, 57.3, 59.4, 61.4, 63.5, 65.5, 67.6, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (5, 4, 57.6, 59.7, 61.8, 63.9, 66, 68, 70.1, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (6, 5, 59.6, 61.7, 63.8, 65.9, 68, 70.1, 72.2, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (7, 6, 61.2, 63.3, 65.5, 67.6, 69.8, 71.9, 74, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (8, 7, 62.7, 64.8, 67, 69.2, 71.3, 73.5, 75.7, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (9, 8, 64, 66.2, 68.4, 70.6, 72.8, 75, 77.2, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (10, 9, 65.2, 67.5, 69.7, 72, 74.2, 76.5, 78.7, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (11, 10, 66.4, 68.7, 71, 73.3, 75.6, 77.9, 80.1, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (12, 11, 67.6, 69.9, 72.2, 74.5, 76.9, 79.2, 81.5, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (13, 12, 68.6, 71, 73.4, 75.7, 78.1, 80.5, 82.9, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (14, 13, 69.6, 72.1, 74.5, 76.9, 79.3, 81.8, 84.2, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (15, 14, 70.6, 73.1, 75.6, 78, 80.5, 83, 85.5, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (16, 15, 71.6, 74.1, 76.6, 79.1, 81.7, 84.2, 86.7, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (17, 16, 72.5, 75, 77.6, 80.2, 82.8, 85.4, 88, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (18, 17, 73.3, 76, 78.6, 81.2, 83.9, 86.5, 89.2, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (19, 18, 74.2, 76.9, 79.6, 82.3, 85, 87.7, 90.4, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (20, 19, 75, 77.7, 80.5, 83.2, 86, 88.8, 91.5, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (21, 20, 75.8, 78.6, 81.4, 84.2, 87, 89.8, 92.6, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (22, 21, 76.5, 79.4, 82.3, 85.1, 88, 90.9, 93.8, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (23, 22, 77.2, 80.2, 83.1, 86, 89, 91.9, 94.9, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (24, 23, 78, 81, 83.9, 86.9, 89.9, 92.9, 95.9, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (25, 241, 78.7, 81.7, 84.8, 87.8, 90.9, 93.9, 97, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (26, 242, 78, 81, 84.1, 87.1, 90.2, 93.2, 96.3, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (27, 25, 78.6, 81.7, 84.9, 88, 91.1, 94.2, 97.3, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (28, 26, 79.3, 82.5, 85.6, 88.8, 92, 95.2, 98.3, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (29, 27, 79.9, 83.1, 86.4, 89.6, 92.9, 96.1, 99.3, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (30, 28, 80.5, 83.8, 87.1, 90.4, 93.7, 97, 100.3, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (31, 29, 81.1, 84.5, 87.8, 91.2, 94.5, 97.9, 101.2, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (32, 30, 81.7, 85.1, 88.5, 91.9, 95.3, 98.7, 102.1, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (33, 31, 82.3, 85.7, 89.2, 92.7, 96.1, 99.6, 103, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (34, 32, 82.8, 86.4, 89.9, 93.4, 96.9, 100.4, 103.9, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (35, 33, 83.4, 86.9, 90.5, 94.1, 97.6, 101.2, 104.8, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (36, 34, 83.9, 87.5, 91.1, 94.8, 98.4, 102, 105.6, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (37, 35, 84.4, 88.1, 91.8, 95.4, 99.1, 102.7, 106.4, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (38, 36, 85, 88.7, 92.4, 96.1, 99.8, 103.5, 107.2, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (39, 37, 85.5, 89.2, 93, 96.7, 100.5, 104.2, 108, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (40, 38, 86, 89.8, 93.6, 97.4, 101.2, 105, 108.8, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (41, 39, 86.5, 90.3, 94.2, 98, 101.8, 105.7, 109.5, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (42, 40, 87, 90.9, 94.7, 98.6, 102.5, 106.4, 110.3, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (43, 41, 87.5, 91.4, 95.3, 99.2, 103.2, 107.1, 111, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (44, 42, 88, 91.9, 95.9, 99.9, 103.8, 107.8, 111.7, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (45, 43, 88.4, 92.4, 96.4, 100.4, 104.5, 108.5, 112.5, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (46, 44, 88.9, 93, 97, 101, 105.1, 109.1, 113.2, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (47, 45, 89.4, 93.5, 97.5, 101.6, 105.7, 109.8, 113.9, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (48, 46, 89.8, 94, 98.1, 102.2, 106.3, 110.4, 114.6, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (49, 47, 90.3, 94.4, 98.6, 102.8, 106.9, 111.1, 115.2, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (50, 48, 90.7, 94.9, 99.1, 103.3, 107.5, 111.7, 115.9, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (51, 49, 91.2, 95.4, 99.7, 103.9, 108.1, 112.4, 116.6, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (52, 50, 91.6, 95.9, 100.2, 104.4, 108.7, 113, 117.3, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (53, 51, 92.1, 96.4, 100.7, 105, 109.3, 113.6, 117.9, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (54, 52, 92.5, 96.9, 101.2, 105.6, 109.9, 114.2, 118.6, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (55, 53, 93, 97.4, 101.7, 106.1, 110.5, 114.9, 119.2, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (56, 54, 93.4, 97.8, 102.3, 106.7, 111.1, 115.5, 119.9, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (57, 55, 93.9, 98.3, 102.8, 107.2, 111.7, 116.1, 120.6, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (58, 56, 94.3, 98.8, 103.3, 107.8, 112.3, 116.7, 121.2, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (59, 57, 94.7, 99.3, 103.8, 108.3, 112.8, 117.4, 121.9, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (60, 58, 95.2, 99.7, 104.3, 108.9, 113.4, 118, 122.6, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (61, 59, 95.6, 100.2, 104.8, 109.4, 114, 118.6, 123.2, '2021-06-27 14:03:35', '2021-06-27 14:03:35');
INSERT INTO `pbl` VALUES (62, 60, 96.1, 100.7, 105.3, 110, 114.6, 119.2, 123.9, '2021-06-27 14:03:35', '2021-06-27 14:03:35');

-- ----------------------------
-- Table structure for pbp
-- ----------------------------
DROP TABLE IF EXISTS `pbp`;
CREATE TABLE `pbp`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `umur` int(11) NOT NULL,
  `min3` float NOT NULL,
  `min2` float NOT NULL,
  `min1` float NOT NULL,
  `median` float NOT NULL,
  `plus1` float NOT NULL,
  `plus2` float NOT NULL,
  `plus3` float NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 63 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pbp
-- ----------------------------
INSERT INTO `pbp` VALUES (1, 0, 43.6, 45.4, 47.3, 49.1, 51, 52.9, 54.7, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (2, 1, 47.8, 49.8, 51.7, 53.7, 55.6, 57.6, 59.5, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (3, 2, 51, 53, 55, 57.1, 59.1, 61.1, 63.2, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (4, 3, 53.5, 55.6, 57.7, 59.8, 61.9, 64, 66.1, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (5, 4, 55.6, 57.8, 59.9, 62.1, 64.3, 66.4, 68.6, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (6, 5, 57.4, 59.6, 61.8, 64, 66.2, 68.5, 70.7, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (7, 6, 58.9, 61.2, 63.5, 65.7, 68, 70.3, 72.5, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (8, 7, 60.3, 62.7, 65, 67.3, 69.6, 71.9, 74.2, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (9, 8, 61.7, 64, 66.4, 68.7, 71.1, 73.5, 75.8, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (10, 9, 62.9, 65.3, 67.7, 70.1, 72.6, 75, 77.4, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (11, 10, 64.1, 66.5, 69, 71.5, 73.9, 76.4, 78.9, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (12, 11, 65.2, 67.7, 70.3, 72.8, 75.3, 77.8, 80.3, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (13, 12, 66.3, 68.9, 71.4, 74, 76.6, 79.2, 81.7, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (14, 13, 67.3, 70, 72.6, 75.2, 77.8, 80.5, 83.1, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (15, 14, 68.3, 71, 73.7, 76.4, 79.1, 81.7, 84.4, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (16, 15, 69.3, 72, 74.8, 77.5, 80.2, 83, 85.7, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (17, 16, 70.2, 73, 75.8, 78.6, 81.4, 84.2, 87, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (18, 17, 71.1, 74, 76.8, 79.7, 82.5, 85.4, 88.2, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (19, 18, 72, 74.9, 77.8, 80.7, 83.6, 86.5, 89.4, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (20, 19, 72.8, 75.8, 78.8, 81.7, 84.7, 87.6, 90.6, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (21, 20, 73.7, 76.7, 79.7, 82.7, 85.7, 88.7, 91.7, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (22, 21, 74.5, 77.5, 80.6, 83.7, 86.7, 89.8, 92.9, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (23, 22, 75.2, 78.4, 81.5, 84.6, 87.7, 90.8, 94, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (24, 23, 76, 79.2, 82.3, 85.5, 88.7, 91.9, 95, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (25, 241, 76.7, 80, 83.2, 86.4, 89.6, 92.9, 96.1, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (26, 242, 76, 79.3, 82.5, 85.7, 88.9, 92.2, 95.4, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (27, 25, 76.8, 80, 83.3, 86.6, 89.9, 93.1, 96.4, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (28, 26, 77.5, 80.8, 84.1, 87.4, 90.8, 94.1, 97.4, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (29, 27, 78.1, 81.5, 84.9, 88.3, 91.7, 95, 98.4, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (30, 28, 78.8, 82.2, 85.7, 89.1, 92.5, 96, 99.4, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (31, 29, 79.5, 82.9, 86.4, 89.9, 93.4, 96.9, 100.3, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (32, 30, 80.1, 83.6, 87.1, 90.7, 94.2, 97.7, 101.3, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (33, 31, 80.7, 84.3, 87.9, 91.4, 95, 98.6, 102.2, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (34, 32, 81.3, 84.9, 88.6, 92.2, 95.8, 99.4, 103.1, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (35, 33, 81.9, 85.6, 89.3, 92.9, 96.6, 100.3, 103.9, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (36, 34, 82.5, 86.2, 89.9, 93.6, 97.4, 101.1, 104.8, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (37, 35, 83.1, 86.8, 90.6, 94.4, 98.1, 101.9, 105.6, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (38, 36, 83.6, 87.4, 91.2, 95.1, 98.9, 102.7, 106.5, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (39, 37, 84.2, 88, 91.9, 95.7, 99.6, 103.4, 107.3, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (40, 38, 84.7, 88.6, 92.5, 96.4, 100.3, 104.2, 108.1, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (41, 39, 85.3, 89.2, 93.1, 97.1, 101, 105, 108.9, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (42, 40, 85.8, 89.8, 93.8, 97.7, 101.7, 105.7, 109.7, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (43, 41, 86.3, 90.4, 94.4, 98.4, 102.4, 106.4, 110.5, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (44, 42, 86.8, 90.9, 95, 99, 103.1, 107.2, 111.2, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (45, 43, 87.4, 91.5, 95.6, 99.7, 103.8, 107.9, 112, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (46, 44, 87.9, 92, 96.2, 100.3, 104.5, 108.6, 112.7, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (47, 45, 88.4, 92.5, 96.7, 100.9, 105.1, 109.3, 113.5, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (48, 46, 88.9, 93.1, 97.3, 101.5, 105.8, 110, 114.2, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (49, 47, 89.3, 93.6, 97.9, 102.1, 106.4, 110.7, 114.9, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (50, 48, 89.8, 94.1, 98.4, 102.7, 107, 111.3, 115.7, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (51, 49, 90.3, 94.6, 99, 103.3, 107.7, 112, 116.4, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (52, 50, 90.7, 95.1, 99.5, 103.9, 108.3, 112.7, 117.1, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (53, 51, 91.2, 95.6, 100.1, 104.5, 108.9, 113.3, 117.7, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (54, 52, 91.7, 96.1, 100.6, 105, 109.5, 114, 118.4, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (55, 53, 92.1, 96.6, 101.1, 105.6, 110.1, 114.6, 119.1, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (56, 54, 92.6, 97.1, 101.6, 106.2, 110.7, 115.2, 119.8, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (57, 55, 93, 97.6, 102.2, 106.7, 111.3, 115.9, 120.4, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (58, 56, 93.4, 98.1, 102.7, 107.3, 111.9, 116.5, 121.1, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (59, 57, 93.9, 98.5, 103.2, 107.8, 112.5, 117.1, 121.8, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (60, 58, 94.3, 99, 103.7, 108.4, 113, 117.7, 122.4, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (61, 59, 94.7, 99.5, 104.2, 108.9, 113.6, 118.3, 123.1, '2021-06-27 14:12:21', '2021-06-27 14:12:21');
INSERT INTO `pbp` VALUES (62, 60, 95.2, 99.9, 104.7, 109.4, 114.2, 118.9, 123.7, '2021-06-27 14:12:21', '2021-06-27 14:12:21');

-- ----------------------------
-- Table structure for pengantins
-- ----------------------------
DROP TABLE IF EXISTS `pengantins`;
CREATE TABLE `pengantins`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pasien_id` bigint(20) UNSIGNED NOT NULL,
  `st_imun` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_imun` date NOT NULL,
  `ikut_kelas` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `berat` double NOT NULL,
  `tinggi` double NOT NULL,
  `lila` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kes_jiwa` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `hiv` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kehamilan` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rwt_penyakit` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rwt_penyakit_klg` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kontrasepsi` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `suhu` double NOT NULL,
  `nadi` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nafas` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tk_darah` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `hb` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `trombosit` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `leukosit` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gol_darah` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rhesus` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gds` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `thalasemia` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `hepatitis_b` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `hepatitis_c` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `torch` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `urin` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pakaian` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pakaian_dlm` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `pengantins_pasien_id_foreign`(`pasien_id`) USING BTREE,
  CONSTRAINT `pengantins_pasien_id_foreign` FOREIGN KEY (`pasien_id`) REFERENCES `pasiens` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pengantins
-- ----------------------------

-- ----------------------------
-- Table structure for puswus
-- ----------------------------
DROP TABLE IF EXISTS `puswus`;
CREATE TABLE `puswus`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `posyandu_id` int(11) NOT NULL,
  `nama_wuspus` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tgl_lahir_wuspus` datetime NULL DEFAULT NULL,
  `nama_suami` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tgl_lahir_suami` datetime NULL DEFAULT NULL,
  `tahapan_ks` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `klp_dasa_wisma` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jml_anak_hidup` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jml_anak_meninggal` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ukuran_lila` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `imunisasi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `kb` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `keterangan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `puswus_to_list_posyandu`(`posyandu_id`) USING BTREE,
  CONSTRAINT `puswus_to_list_posyandu` FOREIGN KEY (`posyandu_id`) REFERENCES `list_posyandu` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of puswus
-- ----------------------------
INSERT INTO `puswus` VALUES (20, 6, 'hu', '2022-07-07 00:00:00', 'hu', '2022-07-06 00:00:00', 'asd', 'as', '1', '2', '24', '{\"kapsul_yodium\":{\"405\":[\"1\",\"2022-07-07\"],\"997\":[\"2\",\"2022-07-08\"],\"457\":[\"3\",\"2022-07-09\"]},\"imunisasi_tt\":{\"620\":[\"1\",\"2022-07-23\"],\"966\":[\"2\",\"2022-07-22\"]}}', '{\"jenis_alkon\":[\"Kondom\",\"Pil\",\"Implant\",\"MOP\"],\"pergantian_alkon\":{\"548\":[\"Pil\",\"2022-07-07\"]}}', 'asf', '2022-07-07 06:07:51', '2022-07-07 10:31:50');

-- ----------------------------
-- Table structure for relasi_bayi
-- ----------------------------
DROP TABLE IF EXISTS `relasi_bayi`;
CREATE TABLE `relasi_bayi`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `users_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `bayi_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `relasi_bayi_user`(`users_id`) USING BTREE,
  INDEX `relasi_bayi`(`bayi_id`) USING BTREE,
  CONSTRAINT `relasi_bayi` FOREIGN KEY (`bayi_id`) REFERENCES `bayi` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `relasi_bayi_user` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of relasi_bayi
-- ----------------------------
INSERT INTO `relasi_bayi` VALUES (11, 59, 84, '2021-07-12 17:31:28', '2021-07-12 17:31:28');

-- ----------------------------
-- Table structure for relasi_bumil
-- ----------------------------
DROP TABLE IF EXISTS `relasi_bumil`;
CREATE TABLE `relasi_bumil`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `users_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `bumils_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `relasi_bayi_user`(`users_id`) USING BTREE,
  INDEX `relasi_bayi`(`bumils_id`) USING BTREE,
  CONSTRAINT `relasi_bumils` FOREIGN KEY (`bumils_id`) REFERENCES `bumils` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `relasi_bumils_user` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 29 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of relasi_bumil
-- ----------------------------
INSERT INTO `relasi_bumil` VALUES (28, 59, 53, '2021-07-12 17:31:28', '2021-07-12 17:31:28');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(1) NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `no_tlp` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `alamat` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `username`(`username`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 61 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'admin', 1, 'Admin', NULL, NULL, '', '', '$2y$10$yGlA6zpBpNErwa7iCVbbAO7yU1OraUL0Ecf2EduY0751SPMIWRRG.', '25gP4E00kLa1pqaoLPZs2EXbrNcb3E5n4yXHcuPSN8WrBbgvso4yq42CLa6n', '2020-09-11 04:37:44', '2021-07-09 13:27:56');
INSERT INTO `users` VALUES (21, 'andika', 2, 'Andika Firman', NULL, NULL, NULL, 'Kemuning Lor Indonesia', '$2y$10$3yS3NNwoyowiqg5TpKdQlOj1Ugz1nedz93HsDWF6VpmEk3vQMUH1y', NULL, '2021-06-18 17:49:18', '2021-07-09 13:25:25');
INSERT INTO `users` VALUES (59, 'rohias', 3, '1', NULL, NULL, NULL, NULL, '$2y$10$TF7Vead/rCD1lxehmvZ3Eu3x3Pi3jGUlpOgn0fXW18PtQEaPCdgz2', NULL, '2021-07-12 16:57:17', '2021-07-12 17:15:53');
INSERT INTO `users` VALUES (60, 'kaderisa', 2, 'Kaderisa', 'oke@gmail.com', NULL, '090909099', 'Jayakarta', '$2y$10$aD.FjnaNM6kAV.Asjc7DzOW5WqdWeGQpvK9wHU7cV8CihkzPzWXCi', NULL, '2022-07-02 12:22:55', '2022-07-02 12:22:55');

SET FOREIGN_KEY_CHECKS = 1;
