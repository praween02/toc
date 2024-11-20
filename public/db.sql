-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 27, 2023 at 01:02 PM
-- Server version: 5.6.51
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `glab_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tcil_equipments`
--

CREATE TABLE `tcil_equipments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `equipment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Equipment',
  `model` varchar(96) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Model',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tcil_equipments`
--

INSERT INTO `tcil_equipments` (`id`, `equipment`, `model`, `created_at`, `updated_at`) VALUES
(1, '5G Core', 'Niral OS 5G Core', '2023-12-16 10:55:26', '2023-12-16 10:55:26'),
(2, '5G Radio', 'STGNB2215-XXID', '2023-12-16 10:55:26', '2023-12-16 10:55:26'),
(3, 'IMS Solution', 'Niral IMS or equivalent', '2023-12-16 10:55:26', '2023-12-16 10:55:26'),
(4, 'MEC & Application Server', 'Niral OS  Edge compute', '2023-12-16 10:55:26', '2023-12-16 10:55:26'),
(5, 'NMS (With Dashboard)', 'Signaltron NMS or equivalent', '2023-12-16 10:55:26', '2023-12-16 10:55:26'),
(6, 'Router with Firewall', 'Cosgrid Firewall or equivalent', '2023-12-16 10:55:26', '2023-12-16 10:55:26'),
(7, '5G SIMs', 'Signaltron Sim', '2023-12-16 10:55:26', '2023-12-16 10:55:26'),
(8, '5G Evaluation Board I Hardware and Software Development Kit.', 'Signaltron 5G CPE', '2023-12-16 10:55:26', '2023-12-16 10:55:26'),
(9, 'IoT Gateway', 'Creative Microsystems IoT or equivalent', '2023-12-16 10:55:26', '2023-12-16 10:55:26'),
(10, 'IoT sensors with analytics software (Loaded in Application server) ', 'Signaltron Sensor', '2023-12-16 10:55:26', '2023-12-16 10:55:26'),
(11, 'Temperature & Humidity Sensor', 'Signaltron Sensor', '2023-12-16 10:55:26', '2023-12-16 10:55:26'),
(12, 'Light Sensor', 'Signaltron Sensor', '2023-12-16 10:55:26', '2023-12-16 10:55:26'),
(13, 'Soil Sensor (NPK)', 'Signaltron Sensor', '2023-12-16 10:55:26', '2023-12-16 10:55:26'),
(14, 'Water (TDS/ch lorine) Sensor ', 'Signaltron Sensor', '2023-12-16 10:55:26', '2023-12-16 10:55:26'),
(15, '5G Mini Drone', 'Menthosa 5G drone or equivalent', '2023-12-16 10:55:26', '2023-12-16 10:55:26'),
(16, '5G XR(ARNR/MR)headset or Device (with loaded application such as remote maintenance I training/skill development/education etc.)', 'AjnaXR or equivalent', '2023-12-16 10:55:26', '2023-12-16 10:55:26'),
(17, '5G Indoor CPE', 'Kenstel KCP-5G-510I or equivalent', '2023-12-16 10:55:26', '2023-12-16 10:55:26'),
(18, '5G Camera with Al enabled Video Analytics (Face/Object/Motion detection, people counting etc.)', 'Sparsh SC-IM82NP-I or equivalent', '2023-12-16 10:55:26', '2023-12-16 10:55:26'),
(19, '5G Handsets', 'Samsung M13 or equivalent', '2023-12-16 10:55:26', '2023-12-16 10:55:26'),
(20, 'Adjustable Tripod Pole (3m)', 'NA', '2023-12-16 10:55:26', '2023-12-16 10:55:26'),
(21, '24 U Rack', 'Trendteck or equivalent', '2023-12-16 10:55:26', '2023-12-16 10:55:26'),
(22, 'UPS 5KVA (1hr backup)', 'Microtek JMSW5500 or equivalnet', '2023-12-16 10:55:26', '2023-12-16 10:55:26'),
(23, '32 inch  FHD Display', 'Samsung Smart M8 or equivalent', '2023-12-16 10:55:26', '2023-12-16 10:55:26'),
(24, 'L2 Managed Switch (24 port)', 'Nivetti NSP-4XGES24GE or equivalent', '2023-12-16 10:55:26', '2023-12-16 10:55:26'),
(25, 'Testing & Tracing Tools', 'Niral Testing and Tracing or equivalent', '2023-12-16 10:55:26', '2023-12-16 10:55:26');

-- --------------------------------------------------------

--
-- Table structure for table `tcil_equipment_suppliers`
--

CREATE TABLE `tcil_equipment_suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Company Name',
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Address',
  `email` varchar(96) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Email',
  `contact_person` varchar(96) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Contact Person',
  `contact_number` varchar(96) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Contact Number',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tcil_equipment_suppliers`
--

INSERT INTO `tcil_equipment_suppliers` (`id`, `company_name`, `address`, `email`, `contact_person`, `contact_number`, `created_at`, `updated_at`) VALUES
(1, 'Wireless 4 Scale', 'IIT Delhi', 'ceo@w4s-lab.in', 'Ashish Singh', '9811039921', '2023-12-18 04:56:51', '2023-12-18 04:56:51');

-- --------------------------------------------------------

--
-- Table structure for table `tcil_failed_jobs`
--

CREATE TABLE `tcil_failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tcil_institutes`
--

CREATE TABLE `tcil_institutes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `zone_id` tinyint(3) UNSIGNED NOT NULL COMMENT 'Zone Id',
  `institute` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Institute Name',
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Address',
  `email` varchar(96) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Email',
  `contact_person` varchar(96) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Contact Person',
  `contact_number` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Contact Number',
  `state` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'State',
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Designation',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Status [0 - Inactive, 1 - Active]',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tcil_institutes`
--

INSERT INTO `tcil_institutes` (`id`, `zone_id`, `institute`, `address`, `email`, `contact_person`, `contact_number`, `state`, `designation`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 'Indian Institute Of Information Technology Design And Manufacturing Kurnool', 'Indian Institute of Information Technology Design and Manufacturing Kurnool Jagannathagattu, Kurnool, Andhra Pradesh, 518007', 'krishnanaik@iiitk.ac.in', 'Dr.k.krishna Naik', '8275203259', 'Andhra Pradesh', 'Associate Professor', 1, NULL, NULL),
(2, 4, 'Koneru Lakshmaiah Education Foundation', 'K L Deemed to be University,Admin. Office, 29_36_38, Museum Road, Governorpet, Vijayawada. A.P., India. Pincode 520 002', 'dvratnam@kluniversity.in', 'Dr D Venkata Ratnam', '8179100442', 'Andhra Pradesh', 'Professor', 1, NULL, NULL),
(3, 4, 'Vignans Foundation For Science Technology And Research', 'Vadlamudi', 'dryrs_ece@vignan.ac.in', 'Ravi Sekhar Yarrabothu', '9243440775', 'Andhra Pradesh', 'Dean Technology Development', 1, NULL, NULL),
(4, 4, 'Gitam Institute Of Technology And Management, Deemed To Be University', 'Department of CSE, GITAM School of Technology, GITAM Deemed to be University, Visakhapatnam 530045', 'hod_cse@gitam.edu', 'Dr. Sireesha Rodda', '9848503365', 'Andhra Pradesh', 'Professor, HoD CSE', 1, NULL, NULL),
(5, 4, 'Indian Institute Of Technology Tirupati', 'Yerpedu Venkatagiri Road, Yerpedu Post, Tirupati District, Pincode 517619', 'naveenkp@iittp.ac.in', 'K P Naveen', '9566084352', 'Andhra Pradesh', 'Assistant Professor', 1, NULL, NULL),
(6, 4, 'National Institute Of Technology Arunachal Pradesh', 'Village Jote, Post Office NIT Jote, Balijan Circle, Sangdupota, District Papum Pare, Arunachal Pradesh, Pin 791113', 'rajat@nitap.ac.in', 'Dr. Rajat Subhra Goswami', '9436271052', 'Arunachal Pradesh', 'Associate Professor, HoD, Dept. of CSE', 1, NULL, NULL),
(7, 1, 'Indian Institute Of Technology Guwahati', 'Indian Institute of Technology Guwahati, Guwahati 781039, Assam, India', 'hodeee@iitg.ac.in', 'Prof. Roy Paily Palathinkal', '9435548082', 'Assam', 'Professor and Head of Department, Electronics and Electrical Engineering', 1, NULL, NULL),
(8, 1, 'National Institute Of Technology Silchar', 'Silchar, Cachar', 'hod@ece.nits.ac.in', 'Rabul Hussain Laskar', '9401437104', 'Assam', 'Professor', 1, NULL, NULL),
(9, 1, 'National Institute Of Technology Patna', 'Ashok Rajpath, Patna 800005, Bihar, India', 'sahana@nitp.ac.in', 'Dr. Bikash Chandra Sahana', '9430427925', 'Bihar', 'Associate Professor', 1, NULL, NULL),
(10, 1, 'Indian Institute Of Technology Patna', 'IIT Patna Bihta Campus, Amhara Road, Bihta, Patna, Bihar, India, Pin Code 801106', 'ee_head@iitp.ac.in', 'Professor Preetam Kumar', '9006993774', 'Bihar', 'Head, Department of Electrical Engineering, IIT Patna', 1, NULL, NULL),
(11, 1, 'Dr Rajendra Prasad Central Agricultural University', 'Dr Ambrish Kumar, Dean, College of Agricultural Engineering and Technology, Dr Rajendra Prasad Central Agricultural University, Pusa 848125, Samastipur', 'aris@rpcau.ac.in', 'Dr Sanjay Kumar Patel', '6287797177', 'Bihar', 'Officer in Charge', 1, NULL, NULL),
(12, 3, 'Punjab Engineering College Deemed To Be University', 'Sector 12, Chandigarh, 160012', 'deanrp@pec.edu.in', 'Dr. Arun Kumar Singh', '9815912699', 'Chandigarh', 'Head, Sponsored Research and Industrial Consultancy', 1, NULL, NULL),
(13, 3, 'University Institute Of Engineering And Technology Panjab University', 'Sector 25, Chandigarh, 160014', 'sakshi@pu.ac.in', 'Sakshi Kaushal', '9872236600', 'Chandigarh', 'Professor', 1, NULL, NULL),
(14, 1, 'Iit Bhilai', 'Sejbahar', 'arzad.alam@iitbhilai.ac.in', 'Arzad Alam Kherani', '9741987453', 'Chhattisgarh', 'Associate Professor', 1, NULL, NULL),
(15, 1, 'National Institute Of Technology Raipur', 'GE Road Raipur CG 492010', 'sdeshmukh.etc@nitrr.ac.in', 'Siddharth Deshmukh', '8280471030', 'Chhattisgarh', 'Associate Professor', 1, NULL, NULL),
(16, 5, 'Delhi Technological University', 'SHAHBAD DAULATPUR, Main Bawana Road, Delhi 110042', 'opverma@dcedotacdotin', 'Prof O P Verma', '9910050177', 'Delhi', 'Professor Head of ECE Department', 1, NULL, NULL),
(17, 5, 'Indraprastha Institute Of Information Technology Delhi', 'Okhla Industrial Estate, Phase III, near Govind Puri Metro Station, New Delhi, 110020', 'arani@iiitd.ac.in', 'Arani Bhattacharya', '7042150880', 'Delhi', 'Assistant Professor', 1, NULL, NULL),
(18, 5, 'Jamia Hamdard', 'Hamdard Nagar, MB Road, New Delhi', 'tabrez.nafis@jamiahamdard.ac.in', 'Md Tabrez Nafis', '9953448275', 'Delhi', 'Assistant Professor', 1, NULL, NULL),
(19, 5, 'Indian Agricultural Research Institute', 'Pusa New Delhi', 'rabi.sahoo@icar.gov.in', 'Dr. Rabi N Sahoo', '9868206724', 'Delhi', 'Principal Scientist', 1, NULL, NULL),
(20, 2, 'Birla Institute Of Technology And Science, K. K. Birla Goa Campus', 'NH 17B, By Pass Road Zuarinagar', 'ssahay@goa.bits-pilani.ac.in', 'Sanjay Kumar Sahay', '9834124309', 'Goa', 'Professor', 1, NULL, NULL),
(21, 2, 'National Institute Of Technology Goa', 'Behind ITI, Goa College of Engineering Campus, Farmagudi, Ponda, Goa', 'director@nitgoa.ac.in', 'Prof. Anupam Shukla', '9765444061', 'Goa', 'Professor', 1, NULL, NULL),
(22, 2, 'Sardar Vallbhbhai National Institute Of Technology', 'SVNIT,Ichchanath, Surat, Gujarat 395007', 'udd@eced.svnit.ac.in', 'Prof Upena D Dalal', '9898057727', 'Gujarat', 'Professor', 1, NULL, NULL),
(23, 2, 'School Of Cyber Security And Digital Forensics National Forensic Sciences University Institute Of National Importance Ministry Of Home Affairs Goi', 'Sector 9 Gandhinagar', 'digvijay.rathod@nfsu.ac.in', 'Digvijaysinh Rathod', '9723619183', 'Gujarat', 'Associate Dean', 1, NULL, NULL),
(24, 2, 'Indian Institute Of Technology Gandhinagar', '23, Palaj, Gandhinagar, 382355', 'sameergk@iitgn.ac.in', 'Sameer G. Kulkarni', '7625065828', 'Gujarat', 'Assistant Professor', 1, NULL, NULL),
(25, 3, 'Central University Of Haryana', 'Mahendergarh 123031', 'rkdhiman@cuh.ac.in', 'Rakesh Kumar', '9416327669', 'Haryana', 'Professor', 1, NULL, NULL),
(26, 3, 'Ntional Power Training Institute', 'NPTI Sector 33 Faridabad', 'manju.npti@gov.in', 'Manju Mam', '9313354788', 'Haryana', 'Principal Director', 1, NULL, NULL),
(27, 3, 'National Institute Of Technology Hamirpur', 'Department Electronics and Communication Engineering, Department of Computer Science and Engineering Hamirpur, Himachal Pardesh, India 177005', 'head.ece@nith.ac.in', 'Dr Gargi Khanna', '9805870101', 'Himachal Pradesh', 'Head DoECE', 1, NULL, NULL),
(28, 3, 'Indian Institute Of Technology Mandi', 'VPO Kamand, Distt. Mandi, Himachal Pradesh 175075', 'chairscee@iitmandi.ac.in', 'Samar Agnihotri', '1905267107', 'Himachal Pradesh', 'Chairperson, School of Computing and Electrical Engineering', 1, NULL, NULL),
(29, 3, 'Institute Of Technology, University Of Kashmir', 'Zakura Campus', 'bilalmalik@kashmiruniversity.ac.in', 'Dr. Bilal Ahmad Malik', '9149511050', 'Jammu And Kashmir', 'Senior Scientific Officer', 1, NULL, NULL),
(30, 3, 'Indian Institute Of Technology Jammu', 'Jagti, NH 44, PO Nagrota, Jammu and Kashmir, 181221, India', 'ankur.bansal@iitjammu.ac.in', 'Dr. Ankur Bansal', '9654485300', 'Jammu And Kashmir', 'Assistant Professor, Department of Electrical Engineering, IIT Jammu', 1, NULL, NULL),
(31, 1, 'Birla Institute Of Technology, Mesra', 'MESRA, RANCHI, JHARKHAND, 835215', 'skumar@bitmesra.ac.in', 'Dr. Sanjay Kumar', '7979962737', 'Jharkhand', 'ASSOCIATE PROFESSOR', 1, NULL, NULL),
(32, 1, 'Indian Institute Of Technology, Dhanbad.', 'Dhanbad, Jharkhand, India, 826004', 'ravi@iitism.ac.in', 'Prof. Ravi Kumar Gangwar', '9771457994', 'Jharkhand', 'Associate Professor, HOD of ECE Department', 1, NULL, NULL),
(33, 1, 'National Institute Of Technology Jamshedpur', 'Department of ECE, NIT Jamshedpur, Dist. Saraikela Kharsawan, Jharkhand, 831014', 'basudeb.ece@nitjsr.ac.in', 'Basudeba Behera', '8812016250', 'Jharkhand', 'Assistant Professor', 1, NULL, NULL),
(34, 4, 'Siddaganga Institute Of Technology', 'B.H.Road, Tumakuru 572103', 'principal@sit.ac.in', 'Dr. Dinesh S. V.', '9449852695', 'Karnataka', 'Principal', 1, NULL, NULL),
(35, 2, 'Indian Institute Of Information Technology Dharwad', 'Ittigatti Road, Sattur, Dharwad, Karnataka', 'jagadeesha@iiitdwd.ac.in', 'Dr. Jagadeesha R B', '9241780950', 'Karnataka', 'Assistant Professor', 1, NULL, NULL),
(36, 4, 'Bms College Of Engineering', 'Bull Temple Road Bangalore 19', 'pkm.intn@bmsce.ac.in', 'Preethikmane', '9886570551', 'Karnataka', 'AssociateProfessor', 1, NULL, NULL),
(37, 4, 'Indian Institute Of Science', 'C V Raman Ave, Bangalore 560012', 'shankarks@iisc.ac.in', 'Shankar Kumar Selvaraja', '9481283513', 'Karnataka', 'Associate Professor', 1, NULL, NULL),
(38, 2, 'Vtus Centre For Post Graduate Studies ,kalaburgi', 'VTU Regional office PG Centre Kusnoor Road Kalaburgi', 'baswaraj_gadgay@vtu.ac.in', 'Dr Basavaraj Gadgay', '9448754546', 'Karnataka', 'Professor ,Regional Director', 1, NULL, NULL),
(39, 2, 'Manipal Institute Of Technology', 'Udupi Karkala Rd, Eshwar Nagar, Manipal, Udupi, Karnataka 576104', 'goutham.simha@manipal.edu', 'Dr. Goutham Simha G D', '9740773415', 'Karnataka', 'Associate Professor', 1, NULL, NULL),
(40, 4, 'M. S Ramaiah Institute Of Technology', 'MSR Nagar, Mathikere, Bengaluru, Karnataka 560054', 'vijaykbp@msrit.edu', 'Dr Vijaya Kumar B P', '9980634134', 'Karnataka', 'Professor', 1, NULL, NULL),
(41, 4, 'National Institute Of Technology Karnataka, Surathkal', 'PO Srinivasnagar, Mangaluru, 575025', 'mp_singh@nitk.edu.in', 'Dr. Mahendra Pratap Singh', '9902163692', 'Karnataka', 'Asst. Professor', 1, NULL, NULL),
(42, 4, 'Department Of Electronics, Cochin University Of Science And Technology', 'Department of Electronics, Cochin University of Science and Technology Kochi 682 022, Kerala, INDIA.', 'supriyadoe@gmail.com', 'Dr. Supriya M.h.', '9947379396', 'Kerala', 'Professor and Head', 1, NULL, NULL),
(43, 4, 'National Institute Of Technology Calicut', 'NIT Campus PO 673601 Kozhikode', 'deanrc@nitc.ac.in', 'Sandhyarani N', '9446273684', 'Kerala', 'Dean Research and Consultancy', 1, NULL, NULL),
(44, 4, 'Indian Institute Of Space Science And Technology', 'Valiamala PO, Trivandrum, 695547', 'bsmanoj@iist.ac.in', 'B. S. Manoj', '9400016607', 'Kerala', 'Professor', 1, NULL, NULL),
(45, 4, 'Indian Institute Of Technology Palakkad', 'Indian Institute of Technology Palakkad, Nila Campus, Near Gramalakshmi Mudralayam Kanjikkode, Palakkad, Kerala, Pincode 678623', 'jobinfrancis@iitpkd.ac.in', 'Dr. Jobin Francis', '6282526214', 'Kerala', 'Assistant Professor', 1, NULL, NULL),
(46, 2, 'Pdpm Indian Institute Of Information Technology, Desing And Manufacturing Jabalpur', 'Dumna Airport Road , 482005', 'mbansal@iiitdmj.ac.in', 'Matadeen Bansal', '9425156287', 'Madhya Pradesh', 'Assistant Professor', 1, NULL, NULL),
(47, 2, 'Indian Institute Of Technology Indore', 'Khandwa Road, Simrol, Indore 453552, India', 'dean.rnd@iiti.ac.in', 'I A Palani', '9009356097', 'Madhya Pradesh', 'Professor', 1, NULL, NULL),
(48, 2, 'Atal Bihari Vajpayee Indian Institute Of Information Technology And Management, Gwalior, Madhya Pradesh', 'ABV Indian Institute of Information Technology and Management Gwalior, Morena Link Road, Gwalior, Madhya Pradesh, India,474015', 'pinkuranjan@iiitm.ac.in', 'Dr. Pinku Ranjan', '7991101270', 'Madhya Pradesh', 'Assistant Professor', 1, NULL, NULL),
(49, 2, 'Maulana Azad National Institute Of Technology, Bhopal, M.p.', 'Maulana Azad National Institute of Technology, Bhopal, M.P.', 'gupta.lalita@gmail.com', 'Dr. Lalita Gupta', '9425017886', 'Madhya Pradesh', 'Associate Professor ECE Department', 1, NULL, NULL),
(50, 2, 'Dpu, Dr D Y Patil School Of Science And Technology', 'Survey No 8 7 88, Mumbai Bangalore Express Highway, Tathawade, Pune 411 033 India.', 'manisha.bhende@dpu.edu.in', 'Dr Manisha Bhende', '9730043149', 'Maharashtra', 'Professor in Computer Science and Design', 1, NULL, NULL),
(51, 2, 'Symbiosis Institute Of Technology, Pune', 'Near Lupin Research Park, Gram Lavale, Tal Mulshi, Pune 412115', 'director@sitpune.edu.in', 'Dr. Ketan Kotecha', '9081225577', 'Maharashtra', 'Director, Symbiosis Institute of Technology Pune, Dean, Faculty of Engineering and Head, Symbiosis Centre for Applied Artificial Intelligence', 1, NULL, NULL),
(52, 2, 'Visvesvaraya National Institute Of Technology, Nagpur', 'South Ambazari Road, Nagpur', 'prabhatsharma@ece.vnit.ac.in', 'Dr. Prabhat Kumar Sharma', '8860532330', 'Maharashtra', 'Assistant Professor', 1, NULL, NULL),
(53, 2, 'Savitribai Phule Pune University, Ms And Dr. Babasaheb Ambedkar Technological University, Lonere, Ms Joint Proposal By 2 Universities', 'Savitribai Phule Pune University, Ganeshkhind Road, Pune and Pune Regional Centre of Dr. Babasaheb Ambedkar Technological University, Department of Technology, Savitribai Phule Pune University, Ganeshkhind Road, Pune', 'pranotibansodeoffice@gmail.com', 'Dr. Pranoti S. Bansode , Dr. S.l. Nalbalwar, Dr. Aditya Abhyankar ,dr. Aditee Joshi', '8408875007', 'Maharashtra', 'Assistant Professor', 1, NULL, NULL),
(54, 2, 'Coep Technological University', 'College of Engg. Pune, Wellesely Rd Shivajinagar, Pune 411 005 Maharashtra INDIA.', 'rdj.extc@coeptech.ac.in', 'Dr. Mrs. Radhika D. Joshi', '9881404632', 'Maharashtra', 'Associate Professor', 1, NULL, NULL),
(55, 2, 'Government College Of Pharmacy Amravati', 'Kathora Naka VMV Road Amravati 444604', 'principal.gcopamravati@dtemaharashtra.gov.in', 'Dr. S. S. Khadabadi', '9370159421', 'Maharashtra', 'Principal', 1, NULL, NULL),
(56, 2, 'Dktes Textile And Engineering Institute, Ichalkaranji', 'Rajwada P.O.Box. No.130 Ichalkaranji 416 115 Dist Kolhapur', 'sapatil@dkte.ac.in', 'Dr.shrinivas A.patil', '9822524667', 'Maharashtra', 'Professor', 1, NULL, NULL),
(57, 1, 'National Institute Of Technology Manipur', 'Langol Rd, Lamphelpat, Imphal, Manipur 795004', 'kalyankgec@gmail.com', 'Kalyan Mondal', '9432514642', 'Manipur', 'Assistant Professor', 1, NULL, NULL),
(58, 1, 'Indian Institute Of Information Technology Senapati, Manipur', 'Mantripukhri, Imphal East 795002', 'nagesh@iiitmanipur.ac.in', 'Dr Nagesh Ch', '9678554904', 'Manipur', 'Assistant Professor', 1, NULL, NULL),
(59, 1, 'National Institute Of Technology Meghalaya', 'Bijni Complex Laitumkhrah Shillong 793003 Meghalaya India', 'prabir.saha@nitm.ac.in', 'Prabir Kumar Saha', '9485177005', 'Meghalaya', 'Assistant Professor', 1, NULL, NULL),
(60, 1, 'National Institute Of Technology Mizoram', 'NIT Mizoram, Chaltatlang, Aizawl 796012', 'chaitali.ece@nitmz.ac.in', 'Dr. Chaitali Koley', '8794620464', 'Mizoram', 'Assistant Professor', 1, NULL, NULL),
(61, 1, 'Christian Institute Of Health Sciences And Research', '4th Mile, PO ARTC Dimapur, 797115', 'sedevi@gmail.com', 'Dr Sedevi Angami', '9862583193', 'Nagaland', 'Director', 1, NULL, NULL),
(62, 1, 'National Institute Of Technology Nagaland', 'Chumukedima', 'chinnamuthu@nitnagaland.ac.in', 'Dr. P. Chinnamuthu', '8974486446', 'Nagaland', 'Associate Professor', 1, NULL, NULL),
(63, 1, 'Indian Institute Of Technology Bhubaneswar', 'At Arugul Po Jatni Dt Khordha', 'pks@iitbbs.ac.in', 'Prof. Prasant Kumar Sahu', '9437140138', 'Odisha', 'Professor', 1, NULL, NULL),
(64, 1, 'Siksha O Anusandhan Deemed To Be University', 'Institute of Technical Education and Research, Jagamara, Khandagiri, Bhubaneswar, Odisha 751030', 'director.iter@soa.ac.in', 'Prof Manas Kumar Mallick', '9437035924', 'Odisha', 'Director', 1, NULL, NULL),
(65, 1, 'Kalinga Institute Of Industrial Technology Deemed To Be University', 'School of Electronics Engineering, Campus12, KIIT Deemed to be University, PO KIIT Bhubaneswar, Odisha, India, Pin 751024', 'ssinghfet@kiit.ac.in', 'Dr. Sudhansu Sekhar Singh', '9437164362', 'Odisha', 'Professor', 1, NULL, NULL),
(66, 1, 'National Institute Of Technology Rourkela', 'Electronics and Communication Engineering Department', 'psingh@nitrkl.ac.in', 'Poonam Singh', '9438246593', 'Odisha', 'Professor', 1, NULL, NULL),
(67, 4, 'National Institute Of Technology Puducherry', 'Thiruvettakudy, Karaikal, Puducherry U.T., Pin 609609', 'surendar.m@nitpy.ac.in', 'Surendar M', '8807959440', 'Puducherry', 'Assistant Professor', 1, NULL, NULL),
(68, 4, 'Pondicherry University', 'Department Of Electronics Engineering, Kalapet', 'shanmuga.dee@pondiuni.edu.in', 'Dr T Shanmuganantham', '486640168', 'Puducherry', 'HEAD OF THE DEPARTMENT', 1, NULL, NULL),
(69, 3, 'Dr B R Ambedkar Nit Jalandhar', 'GT ROAD AMRITSAR BY PASS JALANDHAR', 'kumarmohit@nitj.ac.in', 'Mohit Kumar', '9759950380', 'Punjab', 'Assistant Professor', 1, NULL, NULL),
(70, 3, 'Thapar Institute Of Engineering And Technology', 'Thapar Institute of Engineering and Technology, P.Box No 32 , Patiala 147004', 'rkhanna@thapar.edu', 'Rajesh Khanna', '9872883263', 'Punjab', 'Professor', 1, NULL, NULL),
(71, 3, 'Guru Nanak Dev University, Amritsar', 'Guru Nanak Dev University, GT Road, Amritsar,143005', 'head.ece@gndu.ac.in', 'Dr.ravinder Kumar', '8146622326', 'Punjab', 'Head of Department, Electronics Technology', 1, NULL, NULL),
(72, 3, 'Indian Institute Of Technology Ropar', 'Indian Institute of Technology Ropar, Main Campus, Birla Farms, Rupnagar, Punjab 140001, India', 'ashwani.sharma@iitrpr.ac.in', 'Ashwani Sharma', '9805055287', 'Punjab', 'Assistant Professor', 1, NULL, NULL),
(73, 3, 'Banasthali Vidyapith', 'Banasthali, Tonk 304022', 'anshumanshastri@banasthali.in', 'Dr. Anshuman Shastri', '9828477448', 'Rajasthan', 'Director, Centre of Artificial Intelligence', 1, NULL, NULL),
(74, 3, 'Birla Institute Of Technology And Science Pilani', 'BITS Pilani, Pilani Campus, Vidya Vihar, Pilani 333031, Rajasthan, India', 'hod.eee@pilani.bits-pilani.ac.in', 'Prof. Navneet Gupta', '9772976336', 'Rajasthan', 'Head of the EEE Department', 1, NULL, NULL),
(75, 2, 'Indian Institute Of Technology Jodhpur', 'NH 62 Nagour Road Karwar Jodhpur 342030 Rajasthan India', 'soumava@iitj.ac.in', 'Soumava Mukherjee', '8209615514', 'Rajasthan', 'Assistant Professor', 1, NULL, NULL),
(76, 3, 'Malaviya National Institute Of Technology Jaipur', 'J L N Marg, Jaipur, 302017', 'sjnanda.ece@mnit.ac.in', 'Satyasai Jagannath Nanda', '9549654237', 'Rajasthan', 'Assistant Professor', 1, NULL, NULL),
(77, 2, 'Mbm University, Jodhpur', 'Ratanada, Jodhpur 342011', 'shrwan.cse@mbm.ac.in', 'Dr. Shrwan Ram', '9664134407', 'Rajasthan', 'Professor and Head, Dept. of Computer Science and Engineering', 1, NULL, NULL),
(78, 1, 'Sikkim Manipal Institute Of Technology', 'Majitar, rangpo, East Sikkim , 737136,SIKKIM, INDIA', 'rbera@smit.smu.edu.in', 'Rabindranath Bera', '7908098521', 'Sikkim', 'Professor and HOD, Dept. of AI and DS , SMIT, SMU', 1, NULL, NULL),
(79, 4, 'National Institute Of Technology Tiruchirappalli', 'National Institute of Technology, Tiruchirappalli 620015, Tamil Nadu', 'esgopi@nitt.edu', 'Gopi E S', '9500423313', 'Tamil Nadu', 'Associate professor', 1, NULL, NULL),
(80, 4, 'Vellore Institute Of Technology', 'Vandalur Kelambakkam Road, Chennai, Tamil Nadu 600 127', 'provc.cc@vit.ac.in', 'Dr V S Kanchana Bhaaskaran', '7358782584', 'Tamil Nadu', 'Pro Vice Chancellor', 1, NULL, NULL),
(81, 4, 'College Of Engineering Guindy', 'DEPARTMENT OF ELECTRONICS AND COMMUNICATION ENGINEERING, COLLEGE OF ENGINEERING GUINDY, ANNA UNIVERSITY, CHENNAI 600025', 'directorctdt@gmail.com', 'Dr. N. Balasubramanian', '9444954151', 'Tamil Nadu', 'DIRECTOR, CENTRE FOR SPONSORED RESEARCH AND CONSULTANCY, ANNA UNIVERSITY', 1, NULL, NULL),
(82, 4, 'Sastra Deemed University', 'Tirumalaisamudram, Thanjavur, Tamil Nadu 613 401', 'registrar@sastra.edu', 'Prof. R. Chandramouli', '9894125814', 'Tamil Nadu', 'Registrar', 1, NULL, NULL),
(83, 4, 'Sri Sivasubramaniya Nadar College Of Engineering', 'Rajiv Gandhi salai, Kalavakkam, Chengalpattu 603110', 'vijayalakshmip@ssn.edu.in', 'Dr. P. Vijayalakshmi', '9940415589', 'Tamil Nadu', 'Professor and Head', 1, NULL, NULL),
(84, 4, 'Saveetha Institute Of Medical And Technical Sciences', 'Saveetha Nagar', 'srinivasans.sse@saveetha.com', 'Dr. S. Srinivasan', '9790716830', 'Tamil Nadu', 'Professor and Associate Dean, Department of Electronics and Communication Engineering', 1, NULL, NULL),
(85, 4, 'Srm Institute Of Science And Technology', 'SRM Nagar, Kattankulathur 603203, Chengalpattu District, Chennai', 'hod.ece.ktr@srmist.edu.in', 'Dr. Shanthi Prince', '9444962179', 'Tamil Nadu', 'Professor and Head', 1, NULL, NULL),
(86, 2, 'Iiit Hyderabad', 'International Institute of Information Technology Prof. C R Rao Road Gachibowli, Hyderabad 500 032', 'anuradha.vattem@research.iiit.ac.in', 'Anuradha Vattem', '9866544840', 'Telangana', 'Lead Architect, SCRC', 1, NULL, NULL),
(87, 2, 'National Institute Of Technology Warangal', 'National Institute of Technology Warangal Warangal 506004', 'patri@nitw.ac.in', 'Prof. Patri Sreehari Rao', '9441342324', 'Telangana', 'Head of the Department and Professor', 1, NULL, NULL),
(88, 2, 'University Of Hyderabad', 'University of Hyderabad, Prof. CR Rao Road, Gachibowli, Hyderabad, Telangana, India 500046', 'atul.negi@uohyd.ac.in', 'Prof. Atul Negi', '8008783737', 'Telangana', 'Dean, School of Computer and Information Sciences', 1, NULL, NULL),
(89, 1, 'Tripura Institute Of Technology', 'Narsingarh, PO Agartala Airport, West Tripura, Pin 799009', 'bku.agt@gmail.com', 'Prof. Bijoy Kumar Upadhyaya', '9436502613', 'Tripura', 'Professor', 1, NULL, NULL),
(90, 3, 'Jaypee Institute Of Information Technology, Noida', 'A 10, Sector 62, Noida, PIN 201 309, Uttar Pradesh, India.', 'shweta.srivastava@jiit.ac.in', 'Prof. Shweta Srivastava', '9910175183', 'Uttar Pradesh', 'DEAN Academics and Research, HOD ECE', 1, NULL, NULL),
(91, 3, 'Motilal Nehru National Institute Of Technology Allahabad', 'Motilal Nehru National Institute of Technology Allahabad, Teliyarganj, Prayagraj 211004', 'mayankpandey@mnnit.ac.in', 'Dr. Mayank Pandey', '9935239332', 'Uttar Pradesh', 'Associate Professor, Department of Computer Science and Engineering, FI Computer Centre', 1, NULL, NULL),
(92, 3, 'Indian Institute Of Information Technology Allahabad', 'Indian Institute of Information Technology Allahabad, Jhalwa, Devghat, Prayagraj, 211015, Uttar Pradesh', 'suneel@iiita.ac.in', 'Dr. Suneel Yadav', '8889710363', 'Uttar Pradesh', 'Assistant Professor', 1, NULL, NULL),
(93, 3, 'Aligarh Muslim University', 'Aligarh Muslim University, Aligarh, 202002, UP', 'ekhan.el@amu.ac.in', 'Prof. Ekram Khan', '9457110112', 'Uttar Pradesh', 'Chairperson', 1, NULL, NULL),
(94, 3, 'Indian Institue Of Technology Kanpur', 'IIT Kanpur, Kalyanpur, Kanpur, UP 208016', 'pbagade@iitk.ac.in', 'Priyanka Bagade', '7458061303', 'Uttar Pradesh', 'Assistant Professor', 1, NULL, NULL),
(95, 3, 'Indian Institute Of Technology Bhu', 'Indian Institute of Technology BHU, Varanasi 221005', 'head.ece@iitbhu.ac.in', 'Dr. Manoj Kumar Meshram', '8318478856', 'Uttar Pradesh', 'Professor and Head', 1, NULL, NULL),
(96, 3, 'College Of Technology, Govind Ballabh Pant University Of Agriculture And Technology', 'Post Pantnagar 263 145, Distt Udham Singh Nagar, Uttarakhand, India', 'sanjaymathur.ece@gbpuat-tech.ac.in', 'Dr Sanjay Mathur', '8938006010', 'Uttarakhand', 'Professor and Head, ECE, College of Technology', 1, NULL, NULL),
(97, 3, 'Thdc Institute Of Hydropower Engineering And Technology', 'THDC IHET, Bhagirathipuram, Tehri Garhwal Pincode 249124 Uttarakhand India', 'mahesh@thdcihet.ac.in', 'Mahesh Kumar Aghwariya', '8477944155', 'Uttarakhand', 'Assistant Professor', 1, NULL, NULL),
(98, 3, 'Indian Institute Of Technology Roorkee', 'Roorkee Haridwar Highway, Roorkee, Uttarakhand 247667', 'ekant@ece.iitr.ac.in', 'Ekant Sharma', '8960545002', 'Uttarakhand', 'Assistant Professor', 1, NULL, NULL),
(99, 1, 'National Institute Of Technology Durgapur', 'Department of Electronics and Communication Engineering, M. G. Avenue, Durgapur 713209, West Bengal', 'hod@ece.nitdgp.ac.in', 'Dr. Durbadal Mandal', '9434788059', 'West Bengal', 'Head of the Department', 1, NULL, NULL),
(100, 1, 'Indian Institute Of Information Technology, Kalyani', 'Indian Institute of Information Technology Kalyani, Webel IT Park, Near Buddha Park, Kalyani 741235. Nadia, WB', 'dalia@iiitkalyani.ac.in', 'Dalia Nandi', '7003465005', 'West Bengal', 'Assistant Professor', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tcil_institute_users`
--

CREATE TABLE `tcil_institute_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `institute_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Institute Id',
  `first_name` varchar(96) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'First Name',
  `last_name` varchar(96) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Last Name',
  `phone_no` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Phone Number',
  `email_id` varchar(96) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Email',
  `username` varchar(96) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Username',
  `profile_pic` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Username',
  `gender` enum('M','F','T') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Gender,[M- Male, F-Female, T-Transgender]',
  `user_type` enum('P','S') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'UserType, [P- Professor, S- Student]',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tcil_migrations`
--

CREATE TABLE `tcil_migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tcil_migrations`
--

INSERT INTO `tcil_migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_11_30_105425_create_sessions_table', 1),
(7, '2023_11_30_111824_create_zones_table', 1),
(8, '2023_11_30_111831_create_institutes_table', 1),
(9, '2023_11_30_111837_create_profiles_table', 1),
(10, '2023_12_01_093212_create_vendor_zones_table', 1),
(11, '2023_12_01_093312_create_vendor_institutes_table', 1),
(12, '2023_12_01_120819_create_roles_table', 1),
(13, '2023_12_01_121708_create_role_users_table', 1),
(14, '2023_12_05_101237_create_user_permissions_table', 1),
(15, '2023_12_07_114026_create_institute_users_table', 1),
(16, '2023_12_08_075101_create_equipment_suppliers_table', 1),
(17, '2023_12_15_073105_create_equipments_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tcil_password_reset_tokens`
--

CREATE TABLE `tcil_password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tcil_personal_access_tokens`
--

CREATE TABLE `tcil_personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tcil_profiles`
--

CREATE TABLE `tcil_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL COMMENT 'User Id',
  `address1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Address1',
  `address2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Address2',
  `mobile` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Contact No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tcil_profiles`
--

INSERT INTO `tcil_profiles` (`id`, `user_id`, `address1`, `address2`, `mobile`, `created_at`, `updated_at`) VALUES
(1, 1, 'New Delhi', 'New Delhi', '9898989999', '2023-12-16 09:43:42', '2023-12-16 09:43:42'),
(2, 2, 'New Delhi', 'New Delhi2', '9811039921', '2023-12-16 04:35:55', '2023-12-21 06:43:49'),
(3, 3, 'New Del', NULL, '9898989999', '2023-12-16 07:26:20', '2023-12-16 07:26:20'),
(4, 4, 'delhi', NULL, '8000913222', '2023-12-18 02:36:22', '2023-12-21 06:44:28'),
(5, 5, 'Delhi', NULL, '9873063624', '2023-12-18 02:36:48', '2023-12-21 06:45:09'),
(6, 6, 'Delihi', NULL, '9407444123', '2023-12-18 02:37:15', '2023-12-21 06:45:46');

-- --------------------------------------------------------

--
-- Table structure for table `tcil_roles`
--

CREATE TABLE `tcil_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(96) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Name',
  `slug` varchar(96) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Slug',
  `description` text COLLATE utf8mb4_unicode_ci COMMENT 'Description',
  `permission` text COLLATE utf8mb4_unicode_ci COMMENT 'Permission',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tcil_roles`
--

INSERT INTO `tcil_roles` (`id`, `name`, `slug`, `description`, `permission`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'super_admin', NULL, 'a:0:{}', '2023-12-16 09:40:08', '2023-12-16 09:40:08'),
(2, 'Vendor', 'vendor', NULL, 'O:8:\"stdClass\":24:{s:10:\"users.list\";i:0;s:12:\"users.create\";i:0;s:12:\"users.update\";i:0;s:12:\"users.delete\";i:0;s:10:\"roles.list\";i:0;s:12:\"roles.create\";i:0;s:12:\"roles.update\";i:0;s:12:\"roles.delete\";i:0;s:14:\"institute.list\";i:0;s:16:\"institute.create\";i:0;s:16:\"institute.update\";i:0;s:16:\"institute.delete\";i:0;s:18:\"equ_suppliers.list\";s:1:\"1\";s:20:\"equ_suppliers.create\";s:1:\"1\";s:20:\"equ_suppliers.update\";s:1:\"1\";s:20:\"equ_suppliers.delete\";s:1:\"1\";s:14:\"inst_user.list\";i:0;s:16:\"inst_user.create\";i:0;s:16:\"inst_user.update\";i:0;s:16:\"inst_user.delete\";i:0;s:14:\"equipment.list\";s:1:\"1\";s:16:\"equipment.create\";s:1:\"1\";s:16:\"equipment.update\";s:1:\"1\";s:16:\"equipment.delete\";s:1:\"1\";}', '2023-12-16 04:35:30', '2023-12-18 00:47:22'),
(3, 'Institute', 'institute', NULL, 'O:8:\"stdClass\":24:{s:10:\"users.list\";s:1:\"1\";s:12:\"users.create\";s:1:\"1\";s:12:\"users.update\";s:1:\"1\";s:12:\"users.delete\";s:1:\"1\";s:10:\"roles.list\";s:1:\"1\";s:12:\"roles.create\";s:1:\"1\";s:12:\"roles.update\";s:1:\"1\";s:12:\"roles.delete\";s:1:\"1\";s:14:\"institute.list\";i:0;s:16:\"institute.create\";i:0;s:16:\"institute.update\";i:0;s:16:\"institute.delete\";i:0;s:18:\"equ_suppliers.list\";i:0;s:20:\"equ_suppliers.create\";i:0;s:20:\"equ_suppliers.update\";i:0;s:20:\"equ_suppliers.delete\";i:0;s:14:\"inst_user.list\";i:0;s:16:\"inst_user.create\";i:0;s:16:\"inst_user.update\";i:0;s:16:\"inst_user.delete\";i:0;s:14:\"equipment.list\";i:0;s:16:\"equipment.create\";i:0;s:16:\"equipment.update\";i:0;s:16:\"equipment.delete\";i:0;}', '2023-12-16 07:25:48', '2023-12-16 07:25:48');

-- --------------------------------------------------------

--
-- Table structure for table `tcil_role_users`
--

CREATE TABLE `tcil_role_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Role Id',
  `user_id` bigint(20) UNSIGNED NOT NULL COMMENT 'User Id',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tcil_role_users`
--

INSERT INTO `tcil_role_users` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2023-12-16 09:41:19', '2023-12-16 09:41:19'),
(2, 2, 2, '2023-12-16 04:35:55', '2023-12-21 06:43:49'),
(3, 3, 3, '2023-12-16 07:26:20', '2023-12-16 07:26:20'),
(4, 2, 4, '2023-12-18 02:36:22', '2023-12-21 06:44:28'),
(5, 2, 5, '2023-12-18 02:36:48', '2023-12-21 06:45:09'),
(6, 2, 6, '2023-12-18 02:37:15', '2023-12-21 06:45:46');

-- --------------------------------------------------------

--
-- Table structure for table `tcil_sessions`
--

CREATE TABLE `tcil_sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tcil_sessions`
--

INSERT INTO `tcil_sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('BeK3dBgUF7APSBeInfsI4w6vJTpQquwobbimN5ky', 3, '14.142.186.141', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiTEQxS1hXZmM1T3REQ2dObHpNS21IeUpnbjdBQU1tNk40cHVuUVVPZyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vNWdsYWIuY29tcGFueWRlbW8uaW4vZGFzaGJvYXJkIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MztzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMiRLVnFYMzB0MEZoY1YyQ0RoOE94QS9PZW9SUDNDOGdnL3ZZQzdzOWZFN3NEVlptREI5TGs0RyI7fQ==', 1703653253),
('Kra5uqt8g2McdTsH7AzPAndl56S1sKf4zohtDbna', NULL, '3.250.84.48', 'Plesk screenshot bot https://support.plesk.com/hc/en-us/articles/10301006946066', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY2Z5R3BON2hQQXhVVThKaXlUQTBqOEh1YlN3OGd3Mlp3TXlRNWE3cCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly81Z2xhYi5jb21wYW55ZGVtby5pbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1703662098),
('MjgFW10ueR1lbaAiQ4XW2KEw0GveIjQoAp6Bf2jm', NULL, '14.142.186.141', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoid3RqV2VnOFJDaldPY3VBSlJGWVllajZlQmVWcVdQbWRMaFdnUzlOSCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1703652444),
('OVYb8BFRB4jnjb3g27O6L7pFfF8pVs5F0Rl7luk7', 3, '14.142.186.141', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoic1hJOVFyUmNvdHZlVFdLNXk0RlMzNmM0N0ZxMWwwM0U0SzR5a1ptSSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vNWdsYWIuY29tcGFueWRlbW8uaW4vZGFzaGJvYXJkIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MztzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMiRLVnFYMzB0MEZoY1YyQ0RoOE94QS9PZW9SUDNDOGdnL3ZZQzdzOWZFN3NEVlptREI5TGs0RyI7fQ==', 1703656224),
('S6qBvwIMCmbNEvsOPa8RSUuqnhYY0x3s5Rvr2MeV', 1, '14.142.186.141', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiWEU3UG15eVg3SHo0Z1F2ejZLUU1BVXJ1Z0RvQnVNVlhkdmZDQmptNCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHBzOi8vNWdsYWIuY29tcGFueWRlbW8uaW4vZXF1aXBtZW50cyI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoyMToicGFzc3dvcmRfaGFzaF9zYW5jdHVtIjtzOjYwOiIkMnkkMTAkMlhpb2RNdlE1OVRtaXJjbmJvdEI0dXplNk5vdGcwSDZTL0prV0JRT2loeUtwUnBSSXFsbHEiO30=', 1703660570);

-- --------------------------------------------------------

--
-- Table structure for table `tcil_users`
--

CREATE TABLE `tcil_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tcil_users`
--

INSERT INTO `tcil_users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$10$2XiodMvQ59TmircnbotB4uze6Notg0H6S/JkWBQOihyKpRpRIqllq', NULL, NULL, NULL, 'd80rDXqfAFTDnc4tNFtkQSpAtxvBZ7yBJh6xE5NtznKLi6o4nnuoNOnGfVvj', NULL, 'profile-photos/eewYlVxXH9lv0IjH2Nr5DYUYIOa6Z9Jszasu5BmF.jpg', '2023-12-16 09:41:03', '2023-12-20 02:37:45'),
(2, 'Wireless 4 Scale Laboratory Private Limited', 'ceo@ws-lab.in', NULL, '$2y$12$IvdOp2xG10u3UB2w8Bsv7.UEnpuOWE.FUUFHcY0V3OL0WRcG/Knqi', NULL, NULL, NULL, NULL, NULL, 'profile-photos/87JjfGXTtDvyaX9ECiOO7BfgicdcXtUq3f7CiOq1.jpg', '2023-12-16 04:35:55', '2023-12-21 06:43:49'),
(3, 'institute', 'institute@gmail.com', NULL, '$2y$12$KVqX30t0FhcV2CDh8OxA/OeoRP3C8gg/vYC7s9fE7sDVZmDB9Lk4G', NULL, NULL, NULL, NULL, NULL, 'profile-photos/dD8xYcDQPSYfhJP0arqUa2mrNtpyKE8EQB39EHXY.jpg', '2023-12-16 07:26:20', '2023-12-17 10:37:38'),
(4, 'Coral Telecom Ltd.', 'mukesh.upreti@coraltele.com', NULL, '$2y$12$IvdOp2xG10u3UB2w8Bsv7.UEnpuOWE.FUUFHcY0V3OL0WRcG/Knqi', NULL, NULL, NULL, NULL, NULL, NULL, '2023-12-18 02:36:22', '2023-12-21 06:44:28'),
(5, 'Signaltron Systems Pvt. Ltd.', 'rajesh@signaltron.com', NULL, '$2y$12$IvdOp2xG10u3UB2w8Bsv7.UEnpuOWE.FUUFHcY0V3OL0WRcG/Knqi', NULL, NULL, NULL, NULL, NULL, NULL, '2023-12-18 02:36:48', '2023-12-21 06:45:09'),
(6, 'VVDN Technologies Pvt. Ltd.', 'devansh.rajoriya@vvdntech.in', NULL, '$2y$12$IvdOp2xG10u3UB2w8Bsv7.UEnpuOWE.FUUFHcY0V3OL0WRcG/Knqi', NULL, NULL, NULL, NULL, NULL, NULL, '2023-12-18 02:37:15', '2023-12-21 06:45:46');

-- --------------------------------------------------------

--
-- Table structure for table `tcil_user_permissions`
--

CREATE TABLE `tcil_user_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL COMMENT 'User Id',
  `permission` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Permission',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tcil_user_permissions`
--

INSERT INTO `tcil_user_permissions` (`id`, `user_id`, `permission`, `created_at`, `updated_at`) VALUES
(1, 1, 'a:0:{}', '2023-12-16 09:42:46', '2023-12-16 09:42:46'),
(2, 2, 'O:8:\"stdClass\":24:{s:10:\"users.list\";i:0;s:12:\"users.create\";i:0;s:12:\"users.update\";i:0;s:12:\"users.delete\";i:0;s:10:\"roles.list\";i:0;s:12:\"roles.create\";i:0;s:12:\"roles.update\";i:0;s:12:\"roles.delete\";i:0;s:14:\"institute.list\";s:1:\"1\";s:16:\"institute.create\";i:0;s:16:\"institute.update\";i:0;s:16:\"institute.delete\";i:0;s:18:\"equ_suppliers.list\";i:0;s:20:\"equ_suppliers.create\";i:0;s:20:\"equ_suppliers.update\";i:0;s:20:\"equ_suppliers.delete\";i:0;s:14:\"inst_user.list\";i:0;s:16:\"inst_user.create\";i:0;s:16:\"inst_user.update\";i:0;s:16:\"inst_user.delete\";i:0;s:14:\"equipment.list\";s:1:\"1\";s:16:\"equipment.create\";i:0;s:16:\"equipment.update\";i:0;s:16:\"equipment.delete\";i:0;}', '2023-12-16 04:35:55', '2023-12-18 00:49:40'),
(3, 3, 'O:8:\"stdClass\":24:{s:10:\"users.list\";s:1:\"1\";s:12:\"users.create\";s:1:\"1\";s:12:\"users.update\";s:1:\"1\";s:12:\"users.delete\";s:1:\"1\";s:10:\"roles.list\";s:1:\"1\";s:12:\"roles.create\";s:1:\"1\";s:12:\"roles.update\";s:1:\"1\";s:12:\"roles.delete\";s:1:\"1\";s:14:\"institute.list\";i:0;s:16:\"institute.create\";i:0;s:16:\"institute.update\";i:0;s:16:\"institute.delete\";i:0;s:18:\"equ_suppliers.list\";s:1:\"1\";s:20:\"equ_suppliers.create\";s:1:\"1\";s:20:\"equ_suppliers.update\";s:1:\"1\";s:20:\"equ_suppliers.delete\";s:1:\"1\";s:14:\"inst_user.list\";s:1:\"1\";s:16:\"inst_user.create\";s:1:\"1\";s:16:\"inst_user.update\";s:1:\"1\";s:16:\"inst_user.delete\";s:1:\"1\";s:14:\"equipment.list\";s:1:\"1\";s:16:\"equipment.create\";s:1:\"1\";s:16:\"equipment.update\";s:1:\"1\";s:16:\"equipment.delete\";s:1:\"1\";}', '2023-12-16 07:26:20', '2023-12-17 10:34:51'),
(4, 4, 'O:8:\"stdClass\":24:{s:10:\"users.list\";i:0;s:12:\"users.create\";i:0;s:12:\"users.update\";i:0;s:12:\"users.delete\";i:0;s:10:\"roles.list\";i:0;s:12:\"roles.create\";i:0;s:12:\"roles.update\";i:0;s:12:\"roles.delete\";i:0;s:14:\"institute.list\";i:0;s:16:\"institute.create\";i:0;s:16:\"institute.update\";i:0;s:16:\"institute.delete\";i:0;s:18:\"equ_suppliers.list\";s:1:\"1\";s:20:\"equ_suppliers.create\";s:1:\"1\";s:20:\"equ_suppliers.update\";s:1:\"1\";s:20:\"equ_suppliers.delete\";s:1:\"1\";s:14:\"inst_user.list\";i:0;s:16:\"inst_user.create\";i:0;s:16:\"inst_user.update\";i:0;s:16:\"inst_user.delete\";i:0;s:14:\"equipment.list\";s:1:\"1\";s:16:\"equipment.create\";s:1:\"1\";s:16:\"equipment.update\";s:1:\"1\";s:16:\"equipment.delete\";s:1:\"1\";}', '2023-12-18 02:36:22', '2023-12-18 02:36:22'),
(5, 5, 'O:8:\"stdClass\":24:{s:10:\"users.list\";i:0;s:12:\"users.create\";i:0;s:12:\"users.update\";i:0;s:12:\"users.delete\";i:0;s:10:\"roles.list\";i:0;s:12:\"roles.create\";i:0;s:12:\"roles.update\";i:0;s:12:\"roles.delete\";i:0;s:14:\"institute.list\";i:0;s:16:\"institute.create\";i:0;s:16:\"institute.update\";i:0;s:16:\"institute.delete\";i:0;s:18:\"equ_suppliers.list\";s:1:\"1\";s:20:\"equ_suppliers.create\";s:1:\"1\";s:20:\"equ_suppliers.update\";s:1:\"1\";s:20:\"equ_suppliers.delete\";s:1:\"1\";s:14:\"inst_user.list\";i:0;s:16:\"inst_user.create\";i:0;s:16:\"inst_user.update\";i:0;s:16:\"inst_user.delete\";i:0;s:14:\"equipment.list\";s:1:\"1\";s:16:\"equipment.create\";s:1:\"1\";s:16:\"equipment.update\";s:1:\"1\";s:16:\"equipment.delete\";s:1:\"1\";}', '2023-12-18 02:36:48', '2023-12-18 02:36:48'),
(6, 6, 'O:8:\"stdClass\":24:{s:10:\"users.list\";i:0;s:12:\"users.create\";i:0;s:12:\"users.update\";i:0;s:12:\"users.delete\";i:0;s:10:\"roles.list\";i:0;s:12:\"roles.create\";i:0;s:12:\"roles.update\";i:0;s:12:\"roles.delete\";i:0;s:14:\"institute.list\";i:0;s:16:\"institute.create\";i:0;s:16:\"institute.update\";i:0;s:16:\"institute.delete\";i:0;s:18:\"equ_suppliers.list\";s:1:\"1\";s:20:\"equ_suppliers.create\";s:1:\"1\";s:20:\"equ_suppliers.update\";s:1:\"1\";s:20:\"equ_suppliers.delete\";s:1:\"1\";s:14:\"inst_user.list\";i:0;s:16:\"inst_user.create\";i:0;s:16:\"inst_user.update\";i:0;s:16:\"inst_user.delete\";i:0;s:14:\"equipment.list\";s:1:\"1\";s:16:\"equipment.create\";s:1:\"1\";s:16:\"equipment.update\";s:1:\"1\";s:16:\"equipment.delete\";s:1:\"1\";}', '2023-12-18 02:37:15', '2023-12-18 02:37:15');

-- --------------------------------------------------------

--
-- Table structure for table `tcil_vendor_zones`
--

CREATE TABLE `tcil_vendor_zones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Vendor Id',
  `zone_id` tinyint(3) UNSIGNED NOT NULL COMMENT 'Zone Id',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tcil_vendor_zones`
--

INSERT INTO `tcil_vendor_zones` (`id`, `vendor_id`, `zone_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '2023-12-16 06:11:08', '2023-12-16 06:11:08'),
(2, 2, 5, '2023-12-18 01:43:08', '2023-12-18 01:43:08'),
(3, 4, 2, '2023-12-18 02:54:35', '2023-12-18 02:54:35'),
(4, 5, 3, '2023-12-18 02:54:53', '2023-12-18 02:54:53'),
(5, 6, 4, '2023-12-18 02:55:08', '2023-12-18 02:55:08'),
(6, 4, 5, '2023-12-18 02:56:42', '2023-12-18 02:56:42'),
(7, 5, 5, '2023-12-18 02:57:05', '2023-12-18 02:57:05');

-- --------------------------------------------------------

--
-- Table structure for table `tcil_vendor_zone_institutes`
--

CREATE TABLE `tcil_vendor_zone_institutes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_zone_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Vendor Zone Id',
  `institute_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Institute Id',
  `random_id` varchar(96) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Institute Id',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tcil_vendor_zone_institutes`
--

INSERT INTO `tcil_vendor_zone_institutes` (`id`, `vendor_zone_id`, `institute_id`, `random_id`, `created_at`, `updated_at`) VALUES
(3, 1, 31, 'Ex6LNVsD465VvpsKlcd3CZklmYrT4FKs', '2023-12-18 02:53:41', '2023-12-18 02:53:41'),
(4, 1, 61, 'CqSC3qxvB8Dblcy5jqdMinuoUXzhx243', '2023-12-18 02:53:41', '2023-12-18 02:53:41'),
(5, 1, 11, 'rEwNNifPA9nk20aetQ2AGUYSJqe2H670', '2023-12-18 02:53:41', '2023-12-18 02:53:41'),
(6, 1, 14, 'v2W0cGgOSF8EYv9RS82m1M7BDxQer4xJ', '2023-12-18 02:53:41', '2023-12-18 02:53:41'),
(7, 1, 58, 'yPmfnKqOcAIIDvBuOqZSowI6ovaDw7Ee', '2023-12-18 02:53:41', '2023-12-18 02:53:41'),
(8, 1, 100, 'gb7AhxAfbcGDOyYxbAp7PyOdRG123TZt', '2023-12-18 02:53:41', '2023-12-18 02:53:41'),
(9, 1, 63, 'PuWtrkKFwusRzCZvn6UDonJolnFZ1iZ0', '2023-12-18 02:53:41', '2023-12-18 02:53:41'),
(10, 1, 7, 'Z6rypD5YsRUSR5x7vglkJJkneVOJn1DR', '2023-12-18 02:53:41', '2023-12-18 02:53:41'),
(11, 1, 10, 'xrmy6Br0G0PnL5hKZTlLFs5i8c7teOqO', '2023-12-18 02:53:41', '2023-12-18 02:53:41'),
(12, 1, 32, 'foGvwIvh3yJJi2H784m5u3ow7SNkvm7p', '2023-12-18 02:53:41', '2023-12-18 02:53:41'),
(13, 1, 65, 'BZj5YV50q5vozNtAYCQ5CVK1JzQJkoyQ', '2023-12-18 02:53:41', '2023-12-18 02:53:41'),
(14, 1, 99, 'Hll5wD75hXgLZd58Kz8phu7ZlxD5R1QI', '2023-12-18 02:53:41', '2023-12-18 02:53:41'),
(15, 1, 33, 'QXwZHmj0qhW0f7qmhsrSTqw3T1Grea72', '2023-12-18 02:53:41', '2023-12-18 02:53:41'),
(16, 1, 57, 'ysDvEInrVfAM4l6g619i1Nw2pTtv1DGt', '2023-12-18 02:53:41', '2023-12-18 02:53:41'),
(17, 1, 59, 'fNEV9d6CHzzIRe2j5yWy9o10aFwzCZxz', '2023-12-18 02:53:41', '2023-12-18 02:53:41'),
(18, 1, 60, 'QdLuX8NqqsHFu0uSkmK1ndN2uvu2G6m5', '2023-12-18 02:53:41', '2023-12-18 02:53:41'),
(19, 1, 62, 'Py80UW4EoX3roW5Zhq7CilpnauNSzHq0', '2023-12-18 02:53:41', '2023-12-18 02:53:41'),
(20, 1, 9, 'TVbvTLMyvVRBf6S0qh6rQFqIA96K91TA', '2023-12-18 02:53:41', '2023-12-18 02:53:41'),
(21, 1, 15, 'vr6PAN25ELyfBCUZHhUeA81MAzQUVKPW', '2023-12-18 02:53:41', '2023-12-18 02:53:41'),
(22, 1, 66, 'ORpchyGQE3Ri8vd2rDdZ5HHIUOi2oVlY', '2023-12-18 02:53:41', '2023-12-18 02:53:41'),
(23, 1, 8, 'kM6gDn7BVp8FSPdEGOEO8dToqtPuK5ob', '2023-12-18 02:53:41', '2023-12-18 02:53:41'),
(24, 1, 78, '5HJvjIeJMZ3WQJBi469EKnSC9AhUzYWF', '2023-12-18 02:53:41', '2023-12-18 02:53:41'),
(25, 1, 64, '9mIdksn0Dccs0kgkT92DmIYXmvdn9b53', '2023-12-18 02:53:41', '2023-12-18 02:53:41'),
(26, 1, 89, 'Nr2abMSDS1nzxcXmvZmVCsgQvmMMOUXq', '2023-12-18 02:53:41', '2023-12-18 02:53:41'),
(27, 3, 48, '25scGcRqZBP1s0LvRbVJ3rDzKhgufJBt', '2023-12-18 02:54:35', '2023-12-18 02:54:35'),
(28, 3, 20, 'hGuC4WEUwoXiNhJA8nyQjLRRUXKQSaDR', '2023-12-18 02:54:35', '2023-12-18 02:54:35'),
(29, 3, 54, 'TZEu6x0uCFI8qQ3x99N9EUCR7nbZ0Bg8', '2023-12-18 02:54:35', '2023-12-18 02:54:35'),
(30, 3, 56, '7MXxRrtrlKRgolTenQgyteDHbUXLyvaG', '2023-12-18 02:54:35', '2023-12-18 02:54:35'),
(31, 3, 50, 'BCeMoEG94FnX3WaWB0Kk9comnZ2ETsqB', '2023-12-18 02:54:35', '2023-12-18 02:54:35'),
(32, 3, 55, 'hk7oUoHvIMeHLVZYq5IxzHTfLOXEpFBF', '2023-12-18 02:54:35', '2023-12-18 02:54:35'),
(33, 3, 86, 'RPX3rILjTjeafp1rtnQZtidoOJT8ge72', '2023-12-18 02:54:35', '2023-12-18 02:54:35'),
(34, 3, 35, 'hQ7OvBnUObvTeYfK76C6Uw9zesVADD1x', '2023-12-18 02:54:35', '2023-12-18 02:54:35'),
(35, 3, 24, 'TqlkKY3RnThwYOnxHKcpzxRWLv46hBUl', '2023-12-18 02:54:35', '2023-12-18 02:54:35'),
(36, 3, 47, 'OHO6YsbYnOcSmFjzEkh41blaqHz8ycMN', '2023-12-18 02:54:35', '2023-12-18 02:54:35'),
(37, 3, 75, 'VHAEMrIbvZRA4uRqPzSreITbcxJSug6x', '2023-12-18 02:54:35', '2023-12-18 02:54:35'),
(38, 3, 39, 'BFfUSJAnRIIDsKXD3XMViA6DSI8a7sbl', '2023-12-18 02:54:35', '2023-12-18 02:54:35'),
(39, 3, 49, '8IqwnQ1NLyl9iuZI2ByU9NkwaI7bQ7SR', '2023-12-18 02:54:35', '2023-12-18 02:54:35'),
(40, 3, 77, 'jZ4tNvMzj9yu7VEJzVViViigYGCATtHc', '2023-12-18 02:54:35', '2023-12-18 02:54:35'),
(41, 3, 21, 'uD0xjcqKrISbBcQj5pSlQ3CzT9samwUy', '2023-12-18 02:54:35', '2023-12-18 02:54:35'),
(42, 3, 87, 'bNWs4jAZ8rxwTyqeh9BHRaFuaDfnqOsR', '2023-12-18 02:54:35', '2023-12-18 02:54:35'),
(43, 3, 46, 'xxz0IkBpu0FUhK1KT21EWZbuxdXdivIM', '2023-12-18 02:54:35', '2023-12-18 02:54:35'),
(44, 3, 22, 'eBRmtHejgPE4iwiFS5aHk22vG9dML8yc', '2023-12-18 02:54:35', '2023-12-18 02:54:35'),
(45, 3, 53, '7NDMTi5LeWJGiyazEd2Bd4MzAPpLFkCn', '2023-12-18 02:54:35', '2023-12-18 02:54:35'),
(46, 3, 23, 'kofk67RYZH3asyAaOIYp07zVirFgLTR0', '2023-12-18 02:54:35', '2023-12-18 02:54:35'),
(47, 3, 51, 'yHXkwEanPEYcR7gVwVNLSZVVIiyYnTNj', '2023-12-18 02:54:35', '2023-12-18 02:54:35'),
(48, 3, 88, 'WDfHQCtnjdccKeIoclKleu5VmWwH7SKE', '2023-12-18 02:54:35', '2023-12-18 02:54:35'),
(49, 3, 52, 'p514olXPPzpWiz6q03IbQ31pY1CLjdoJ', '2023-12-18 02:54:35', '2023-12-18 02:54:35'),
(50, 3, 38, 'GUFj3vfBW5KRtj9JHB7bul8iDEWMqKXH', '2023-12-18 02:54:35', '2023-12-18 02:54:35'),
(51, 4, 93, '1l5ZDhIXmEKF5AiHqtQSTX7ZPgHpFeQP', '2023-12-18 02:54:53', '2023-12-18 02:54:53'),
(52, 4, 73, 'X8mTSGOgSg5TYddCojOKzGlgpz3FLi5r', '2023-12-18 02:54:53', '2023-12-18 02:54:53'),
(53, 4, 74, '9IidZHQIihZEG5JJVUQ7UCiTKMl4nkWj', '2023-12-18 02:54:53', '2023-12-18 02:54:53'),
(54, 4, 25, 'T5rVtrIilJs3plegTkkRFrR6aZY3i2OC', '2023-12-18 02:54:53', '2023-12-18 02:54:53'),
(55, 4, 96, 'OB7miGbAlScr9EDkbifQBlGuL3UEqJ5x', '2023-12-18 02:54:53', '2023-12-18 02:54:53'),
(56, 4, 69, 'ivx5qHrv0lVSW1QfPTqhF2DZtNzRxmV8', '2023-12-18 02:54:53', '2023-12-18 02:54:53'),
(57, 4, 71, 'zo38ASBiDddpgViPE3DMaaHy91QcUn7t', '2023-12-18 02:54:53', '2023-12-18 02:54:53'),
(58, 4, 94, 'LPrxX7p9tuB8F5kZ3RNY7IvPxh7uoiRi', '2023-12-18 02:54:53', '2023-12-18 02:54:53'),
(59, 4, 92, 'yVtDaMRp26Vw7MVdUt9Pi3ah9yVF7Oti', '2023-12-18 02:54:53', '2023-12-18 02:54:53'),
(60, 4, 95, 'ooBiF0p4MgHJMuv1TlCqWiUXtYaDVwvA', '2023-12-18 02:54:53', '2023-12-18 02:54:53'),
(61, 4, 30, '9uytoWk7bHHVe29Xg1MaKAD8Zwb2V0cE', '2023-12-18 02:54:53', '2023-12-18 02:54:53'),
(62, 4, 28, 'KJ5r2NyKLZwtKksBBHxWWX9gpCUanh3Y', '2023-12-18 02:54:53', '2023-12-18 02:54:53'),
(63, 4, 98, 'k9KHJgPLuE2PMYkELbDf0W5xgf7gIBlC', '2023-12-18 02:54:53', '2023-12-18 02:54:53'),
(64, 4, 72, 'X1UluV4hZbpvwLNf5hsYylUhDVQsKMiA', '2023-12-18 02:54:53', '2023-12-18 02:54:53'),
(65, 4, 29, 'OfChFNcHRTvQH0LpujvqcZ6RPVBxMDrd', '2023-12-18 02:54:53', '2023-12-18 02:54:53'),
(66, 4, 90, 'JY9fKTdRZqLtDndITfVOTYQdQX8PiOs6', '2023-12-18 02:54:53', '2023-12-18 02:54:53'),
(67, 4, 76, '3t55S1IO5Y9czAK11xu1B8o7ZKmlmOt0', '2023-12-18 02:54:53', '2023-12-18 02:54:53'),
(68, 4, 91, 'WO7tRtitToR6xUaWeei6NqbjklVbIR36', '2023-12-18 02:54:53', '2023-12-18 02:54:53'),
(69, 4, 27, 'QlPnHHTZBsDFiNXTwm5CTJsgpZxYeVb5', '2023-12-18 02:54:53', '2023-12-18 02:54:53'),
(70, 4, 26, 'ebBf1ZG9xv2w7I8f09nIHjcpqFDSlDWU', '2023-12-18 02:54:53', '2023-12-18 02:54:53'),
(71, 4, 12, 'Ah4Z4f6qlVl22lKnX59iRgXyyjEzpgEz', '2023-12-18 02:54:53', '2023-12-18 02:54:53'),
(72, 4, 70, 'bhv45NTiKpV2W0YtzcaAaqayiwwo6uEi', '2023-12-18 02:54:53', '2023-12-18 02:54:53'),
(73, 4, 97, 'iqyuKhj6ncA5XDumaX8h6oiuEGMJ35cl', '2023-12-18 02:54:53', '2023-12-18 02:54:53'),
(74, 4, 13, 't2YPtlgQiidk3de8CkIYYyXti9dJuYSD', '2023-12-18 02:54:53', '2023-12-18 02:54:53'),
(75, 5, 36, 'uB18ibIYJB80NNyQFmTSYAZgTzMaRFee', '2023-12-18 02:55:08', '2023-12-18 02:55:08'),
(76, 5, 81, 'hEjPnxQN3K20lgWU9rNWKXIbnodeK6q6', '2023-12-18 02:55:08', '2023-12-18 02:55:08'),
(77, 5, 42, 'bGTby6cirVrk0JQ4QQ4gpzeXT7nF0YPB', '2023-12-18 02:55:08', '2023-12-18 02:55:08'),
(78, 5, 4, 'HyqKDSeW0oF1jHnYYkf7lXSErfjGN9jf', '2023-12-18 02:55:08', '2023-12-18 02:55:08'),
(79, 5, 1, '7d25DQJP2gZ1XQFANfuqcEwOdCtC8PUD', '2023-12-18 02:55:08', '2023-12-18 02:55:08'),
(80, 5, 37, '9FYZl6Xw0cMtIv8gBy0eBKkCh05cWO33', '2023-12-18 02:55:08', '2023-12-18 02:55:08'),
(81, 5, 44, 'gd9Uu3K7sUkbN4Ia2K2azkeYGueZPpVa', '2023-12-18 02:55:08', '2023-12-18 02:55:08'),
(82, 5, 45, 'oZwmdVvBkgIJtDENRTcall4Yu7OQ8xmb', '2023-12-18 02:55:08', '2023-12-18 02:55:08'),
(83, 5, 5, 'WexJHnXMyWwkpfukRqCgEMXvelTAQNiX', '2023-12-18 02:55:08', '2023-12-18 02:55:08'),
(84, 5, 2, 'CVKTgaqeLyZ7943eeOqHTWm4ixmb8bNC', '2023-12-18 02:55:08', '2023-12-18 02:55:08'),
(85, 5, 40, 'uWw882R9h9KFW8sRle6gjUTTv2NDp2q0', '2023-12-18 02:55:08', '2023-12-18 02:55:08'),
(86, 5, 6, 'LEYHlX5ORnlOG1QCFc22EQfwoTatr1Nc', '2023-12-18 02:55:08', '2023-12-18 02:55:08'),
(87, 5, 43, 'ElGLsNUGcwx5Ct6QJ5ypyo7Ad7Mb3Asv', '2023-12-18 02:55:08', '2023-12-18 02:55:08'),
(88, 5, 41, 'g0QBflFXEmsYRoyaKjxo34Fj9Z4yGsS1', '2023-12-18 02:55:08', '2023-12-18 02:55:08'),
(89, 5, 67, 'kQn6oL3fUjPVKrGCuz5yrSpC41czT34t', '2023-12-18 02:55:08', '2023-12-18 02:55:08'),
(90, 5, 79, 'aVa52VWSvMImklSNmkEldweTKfoGwzLh', '2023-12-18 02:55:08', '2023-12-18 02:55:08'),
(91, 5, 68, 'eBq2ymrxo7eAeXKmREoEuE5nh8hdidph', '2023-12-18 02:55:08', '2023-12-18 02:55:08'),
(92, 5, 82, 's3LVls7DwciAgJA2BYtOfSUN0DiLB1TG', '2023-12-18 02:55:08', '2023-12-18 02:55:08'),
(93, 5, 84, 'jqqZkTIBP2vwZYYXAY0dCmQi0x58hIpb', '2023-12-18 02:55:08', '2023-12-18 02:55:08'),
(94, 5, 34, 'PkWXGa7Owuu0CCF5k7G7QOqz16BR49T9', '2023-12-18 02:55:08', '2023-12-18 02:55:08'),
(95, 5, 83, 'wDQmMwQx0aZd3JvUJvUJudKZJuGi01RX', '2023-12-18 02:55:08', '2023-12-18 02:55:08'),
(96, 5, 85, 'ceABkpJC6abuA0HKTzpUyacT1zzdDzlY', '2023-12-18 02:55:08', '2023-12-18 02:55:08'),
(97, 5, 80, 'gstaty4SlFWZeQufJUKVnGtAihJNg6fM', '2023-12-18 02:55:08', '2023-12-18 02:55:08'),
(98, 5, 3, 'njsjcVVXPOPifoEM2Ilm37wI4ycamR9Y', '2023-12-18 02:55:08', '2023-12-18 02:55:08'),
(99, 2, 16, 'NvQZO1by05sBYUPxGOSNp47dyv7lCrbq', '2023-12-18 02:56:25', '2023-12-18 02:56:25'),
(100, 6, 19, 'KzcWakn6u7lKlgvBlVdS7qMqhgzUKgf3', '2023-12-18 02:56:42', '2023-12-18 02:56:42'),
(101, 7, 17, 'nynMX1RpH8nzOQkuLo8sdmUNgWmubxM4', '2023-12-18 02:57:05', '2023-12-18 02:57:05');

-- --------------------------------------------------------

--
-- Table structure for table `tcil_zones`
--

CREATE TABLE `tcil_zones` (
  `id` tinyint(3) UNSIGNED NOT NULL COMMENT 'Id',
  `zone` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Zone',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Status [0 - Inactive, 1 - Active]',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tcil_zones`
--

INSERT INTO `tcil_zones` (`id`, `zone`, `status`, `created_at`, `updated_at`) VALUES
(1, 'East', 1, '2023-12-14 00:01:33', '2023-12-14 00:01:33'),
(2, 'West', 1, '2023-12-14 00:01:33', '2023-12-14 00:01:33'),
(3, 'North', 1, '2023-12-14 00:01:33', '2023-12-14 00:01:33'),
(4, 'South', 1, '2023-12-14 00:01:33', '2023-12-14 00:01:33'),
(5, 'Central', 1, '2023-12-14 00:01:33', '2023-12-14 00:01:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tcil_equipments`
--
ALTER TABLE `tcil_equipments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tcil_equipment_suppliers`
--
ALTER TABLE `tcil_equipment_suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tcil_failed_jobs`
--
ALTER TABLE `tcil_failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tcil_failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `tcil_institutes`
--
ALTER TABLE `tcil_institutes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tcil_institutes_zone_id_foreign` (`zone_id`);

--
-- Indexes for table `tcil_institute_users`
--
ALTER TABLE `tcil_institute_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tcil_institute_users_institute_id_index` (`institute_id`);

--
-- Indexes for table `tcil_migrations`
--
ALTER TABLE `tcil_migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tcil_password_reset_tokens`
--
ALTER TABLE `tcil_password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `tcil_personal_access_tokens`
--
ALTER TABLE `tcil_personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tcil_personal_access_tokens_token_unique` (`token`),
  ADD KEY `tcil_personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `tcil_profiles`
--
ALTER TABLE `tcil_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tcil_profiles_user_id_foreign` (`user_id`);

--
-- Indexes for table `tcil_roles`
--
ALTER TABLE `tcil_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tcil_roles_name_unique` (`name`);

--
-- Indexes for table `tcil_role_users`
--
ALTER TABLE `tcil_role_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tcil_role_users_role_id_foreign` (`role_id`),
  ADD KEY `tcil_role_users_user_id_foreign` (`user_id`);

--
-- Indexes for table `tcil_sessions`
--
ALTER TABLE `tcil_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tcil_sessions_user_id_index` (`user_id`),
  ADD KEY `tcil_sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tcil_users`
--
ALTER TABLE `tcil_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tcil_users_email_unique` (`email`);

--
-- Indexes for table `tcil_user_permissions`
--
ALTER TABLE `tcil_user_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tcil_user_permissions_user_id_foreign` (`user_id`);

--
-- Indexes for table `tcil_vendor_zones`
--
ALTER TABLE `tcil_vendor_zones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tcil_vendor_zones_vendor_id_foreign` (`vendor_id`),
  ADD KEY `tcil_vendor_zones_zone_id_foreign` (`zone_id`);

--
-- Indexes for table `tcil_vendor_zone_institutes`
--
ALTER TABLE `tcil_vendor_zone_institutes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tcil_vendor_zone_institutes_random_id_unique` (`random_id`),
  ADD KEY `tcil_vendor_zone_institutes_vendor_zone_id_foreign` (`vendor_zone_id`),
  ADD KEY `tcil_vendor_zone_institutes_institute_id_foreign` (`institute_id`),
  ADD KEY `tcil_vendor_zone_institutes_random_id_index` (`random_id`);

--
-- Indexes for table `tcil_zones`
--
ALTER TABLE `tcil_zones`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tcil_equipments`
--
ALTER TABLE `tcil_equipments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tcil_equipment_suppliers`
--
ALTER TABLE `tcil_equipment_suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tcil_failed_jobs`
--
ALTER TABLE `tcil_failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tcil_institutes`
--
ALTER TABLE `tcil_institutes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `tcil_institute_users`
--
ALTER TABLE `tcil_institute_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tcil_migrations`
--
ALTER TABLE `tcil_migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tcil_personal_access_tokens`
--
ALTER TABLE `tcil_personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tcil_profiles`
--
ALTER TABLE `tcil_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tcil_roles`
--
ALTER TABLE `tcil_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tcil_role_users`
--
ALTER TABLE `tcil_role_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tcil_users`
--
ALTER TABLE `tcil_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tcil_user_permissions`
--
ALTER TABLE `tcil_user_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tcil_vendor_zones`
--
ALTER TABLE `tcil_vendor_zones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tcil_vendor_zone_institutes`
--
ALTER TABLE `tcil_vendor_zone_institutes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `tcil_zones`
--
ALTER TABLE `tcil_zones`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id', AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tcil_institutes`
--
ALTER TABLE `tcil_institutes`
  ADD CONSTRAINT `tcil_institutes_zone_id_foreign` FOREIGN KEY (`zone_id`) REFERENCES `tcil_zones` (`id`);

--
-- Constraints for table `tcil_institute_users`
--
ALTER TABLE `tcil_institute_users`
  ADD CONSTRAINT `tcil_institute_users_institute_id_foreign` FOREIGN KEY (`institute_id`) REFERENCES `tcil_institutes` (`id`);

--
-- Constraints for table `tcil_profiles`
--
ALTER TABLE `tcil_profiles`
  ADD CONSTRAINT `tcil_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `tcil_users` (`id`);

--
-- Constraints for table `tcil_role_users`
--
ALTER TABLE `tcil_role_users`
  ADD CONSTRAINT `tcil_role_users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `tcil_roles` (`id`),
  ADD CONSTRAINT `tcil_role_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `tcil_users` (`id`);

--
-- Constraints for table `tcil_user_permissions`
--
ALTER TABLE `tcil_user_permissions`
  ADD CONSTRAINT `tcil_user_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `tcil_users` (`id`);

--
-- Constraints for table `tcil_vendor_zones`
--
ALTER TABLE `tcil_vendor_zones`
  ADD CONSTRAINT `tcil_vendor_zones_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `tcil_users` (`id`),
  ADD CONSTRAINT `tcil_vendor_zones_zone_id_foreign` FOREIGN KEY (`zone_id`) REFERENCES `tcil_zones` (`id`);

--
-- Constraints for table `tcil_vendor_zone_institutes`
--
ALTER TABLE `tcil_vendor_zone_institutes`
  ADD CONSTRAINT `tcil_vendor_zone_institutes_institute_id_foreign` FOREIGN KEY (`institute_id`) REFERENCES `tcil_institutes` (`id`),
  ADD CONSTRAINT `tcil_vendor_zone_institutes_vendor_zone_id_foreign` FOREIGN KEY (`vendor_zone_id`) REFERENCES `tcil_vendor_zones` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
