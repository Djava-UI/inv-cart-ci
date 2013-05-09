-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 08, 2013 at 10:43 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_inv_cart_ci`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang`
--

CREATE TABLE IF NOT EXISTS `tbl_barang` (
  `kd_barang` varchar(10) NOT NULL,
  `nm_barang` varchar(20) NOT NULL,
  `stok` int(10) NOT NULL,
  `harga` int(15) NOT NULL,
  PRIMARY KEY (`kd_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_barang`
--

INSERT INTO `tbl_barang` (`kd_barang`, `nm_barang`, `stok`, `harga`) VALUES
('BR-0000001', 'HP', 2, 120000),
('BR-0000002', 'Tablet', 4, 200000),
('BR-0000003', 'Netbook', 3, 1500000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pelanggan`
--

CREATE TABLE IF NOT EXISTS `tbl_pelanggan` (
  `kd_pelanggan` varchar(10) NOT NULL,
  `nm_pelanggan` varchar(30) NOT NULL,
  `alamat` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  PRIMARY KEY (`kd_pelanggan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pelanggan`
--

INSERT INTO `tbl_pelanggan` (`kd_pelanggan`, `nm_pelanggan`, `alamat`, `email`) VALUES
('PLG-000001', 'Djava-ui', 'jogja', 'support@djava-ui.com'),
('PLG-000002', 'Gilang Sonar', 'Jogja', 'gilangsonar15@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengadaan_detail`
--

CREATE TABLE IF NOT EXISTS `tbl_pengadaan_detail` (
  `kd_pengadaan` varchar(10) NOT NULL,
  `kd_barang` varchar(10) NOT NULL,
  `qty` int(10) NOT NULL,
  `harga` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengadaan_header`
--

CREATE TABLE IF NOT EXISTS `tbl_pengadaan_header` (
  `kd_pengadaan` varchar(10) NOT NULL,
  `total_harga` varchar(20) NOT NULL,
  `tanggal_pengadaan` date NOT NULL,
  PRIMARY KEY (`kd_pengadaan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengeluaran_detail`
--

CREATE TABLE IF NOT EXISTS `tbl_pengeluaran_detail` (
  `kd_pengeluaran` varchar(10) NOT NULL,
  `kd_barang` varchar(10) NOT NULL,
  `qty` int(10) NOT NULL,
  `harga` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengeluaran_header`
--

CREATE TABLE IF NOT EXISTS `tbl_pengeluaran_header` (
  `kd_pengeluaran` varchar(10) NOT NULL,
  `kd_pelanggan` varchar(10) NOT NULL,
  `total_harga` varchar(20) NOT NULL,
  `tanggal_pengeluaran` date NOT NULL,
  PRIMARY KEY (`kd_pengeluaran`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
