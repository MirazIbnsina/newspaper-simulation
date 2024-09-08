# Newspaper Seller's Problem Simulation

This project implements a simulation of the Newspaper Seller's Problem, also known as the Newsvendor Problem. It's a classic example of inventory management and decision-making under uncertainty.

## Project Description

The Newspaper Seller's Problem simulation helps analyze the optimal inventory level for a newspaper vendor who must decide how many newspapers to stock each day. The demand for newspapers is uncertain and varies daily, influenced by factors like weather (represented as "Type of Newsday" in this simulation).

This web-based simulation tool allows users to input various parameters and run a multi-day simulation to see the outcomes of different inventory decisions.

## Features

- Input form for simulation parameters (number of newspapers, costs, sale rates, etc.)
- Random number generation for daily demand and type of newsday
- Calculation of daily and cumulative profits/losses
- Visual representation of simulation results in tables
- Responsive design for easy viewing on different devices

## Technologies Used

- PHP
- HTML
- CSS (Bootstrap 5.3.0)
- JavaScript (optional, for any dynamic features on the client-side)

## Usage

1. On the first page, enter the simulation parameters:
   - Row of Newspaper Demanded and Demands
   - Amount of Daily Newspapers
   - Per Newspaper Cost & Sell rate
   - Salvage Rate of Scrap Paper
![image](https://github.com/user-attachments/assets/a27d5fa5-ee17-4514-9b77-a0a812bd8f9b)


2. On the second page, enter the probability distribution for demand, formated as given numbers and newsday types and Random digits.
![image](https://github.com/user-attachments/assets/cf0902ef-a3c2-490c-bbcd-bcc4f7760ea5)


3. The final page will display the simulation results, including:
   - Distribution of Newspaper Demanded
   - Random-Digit Assignment for Type of Newsday
   - Day-by-day simulation results
   - Total Revenue, Lost Profit, Salvage Value, and Overall Profit
![image](https://github.com/user-attachments/assets/902de57a-012b-4b8b-bfb4-abb02d48e0d6)
