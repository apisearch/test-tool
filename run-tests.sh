#!/bin/bash
echo ===== Running performance test =====
./test-benchmark.sh > test-benchmark.log
cat test-benchmark.log
echo
echo ===== Running search results test =====
./test-search-results.php > test-search-results.log
cat test-search-results.log
