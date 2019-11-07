/**
 * A prime is a positive integer X that has exactly two distinct divisors: 1 and X. The first few prime integers are 2, 3, 5, 7, 11 and 13.

A semiprime is a natural number that is the product of two (not necessarily distinct) prime numbers. The first few semiprimes are 4, 6, 9, 10, 14, 15, 21, 22, 25, 26.

You are given two non-empty arrays P and Q, each consisting of M integers. These arrays represent queries about the number of semiprimes within specified ranges.

Query K requires you to find the number of semiprimes within the range (P[K], Q[K]), where 1 ≤ P[K] ≤ Q[K] ≤ N.

For example, consider an integer N = 26 and arrays P, Q such that:

    P[0] = 1    Q[0] = 26
    P[1] = 4    Q[1] = 10
    P[2] = 16   Q[2] = 20
The number of semiprimes within each of these ranges is as follows:

(1, 26) is 10,
(4, 10) is 4,
(16, 20) is 0.
Write a function:

class Solution { public int[] solution(int N, int[] P, int[] Q); }

that, given an integer N and two non-empty arrays P and Q consisting of M integers, returns an array consisting of M elements specifying the consecutive answers to all the queries.

For example, given an integer N = 26 and arrays P, Q such that:

    P[0] = 1    Q[0] = 26
    P[1] = 4    Q[1] = 10
    P[2] = 16   Q[2] = 20
the function should return the values [10, 4, 0], as explained above.

Write an efficient algorithm for the following assumptions:

N is an integer within the range [1..50,000];
M is an integer within the range [1..30,000];
each element of arrays P, Q is an integer within the range [1..N];
P[i] ≤ Q[i].


@20191104 correct:100%, performance: 40% https://app.codility.com/demo/results/trainingKS3Q8V-RBG/
@20191106 correct:50%, performance: 20% https://app.codility.com/demo/results/trainingY6JCHY-BQX/
 */
import java.util.ArrayList;
import java.util.Arrays;
import java.util.Collections;

 class CountSemiPrimes {
     ArrayList<Integer> primes = new ArrayList<Integer>();
     ArrayList<Integer> sPrimes = new ArrayList<Integer>();

     public int[] solution(int N, int[] P, int[] Q) {
        getPrimes(N);
        getSemiPrimes(N);
       /*
        // test sCount contstructing 
        int m = 0;
        sPrimes.add(m++, 4);
        sPrimes.add(m++, 6);
        sPrimes.add(m++, 8);
        sPrimes.add(m++, 9);
        sPrimes.add(m++, 10);
        sPrimes.add(m++, 11); 
        */

        ArrayList<Integer> sCount = new ArrayList<Integer>();
        int i = 0;
        int sTotal = sPrimes.size();
        boolean noPrimes = false;
        if (sTotal < 1) {
            noPrimes = true;
        } else {
            int sPrime = sPrimes.get(i);
            for (int j = 0; j <= N; j++) {
                if (j < sPrime) {
                    sCount.add(j, i);
                } else {
                    if (i < sTotal) {
                        sCount.add(j, ++i);
                        if (i < sTotal) sPrime = sPrimes.get(i);
                    } else {
                        sCount.add(j, i);
                    }
                }
            }
        }


        int M = P.length;
        int[] R = new int[M];
        for (int j = 0; j < M; j++) {
            int start = P[j];
            int end = Q[j];

            if (noPrimes) {
                R[j] = 0;
            } else {
                if (start - 1 >= 0 && sCount.get(start) > sCount.get(start-1)) R[j] = (sCount.get(end) - sCount.get(start)) + 1;
                else R[j] = sCount.get(end) - sCount.get(start);
            }
        }

        return R;
     }

     private void getPrimes(int N) {
        int sqrtN = (int) Math.sqrt(N);
        boolean[] flags = new boolean[N+1];
        for (int i = 1; i <= N; i++) {
            flags[i] = true;
        }

        for (int i = 2; i < sqrtN; i++) {
            for (int j = 2; j <= N / 2; j++) {
                if (j != i && j % i == 0 && flags[j] == true) flags[j] = false;
            }
        }

        for (int i = 2; i <= N / 2; i++) {
            if (flags[i]) primes.add(i);
        }
     }

     private void getSemiPrimes(int N) {
        int L = primes.size();

        for (int i = 0; i < L; i++) {
            for (int j = i; j < L; j++) {
                int t = primes.get(i) * primes.get(j);
                if (t > N) break;
                sPrimes.add(t);
            }
        }

        Collections.sort(sPrimes);
     }

     public static void main(String[] args) {
         CountSemiPrimes cs = new CountSemiPrimes();
         int[] P = new int[] {1, 4, 16};
         int[] Q = new int[] {26, 10, 20};

         int[] P1 = new int[] {1};
         int[] Q1 = new int[] {1};
         int[] re = cs.solution(26, P, Q);
         for (int i:re) {
             System.out.print(i + ", ");
         }
         System.out.println();
         System.out.println((int) Math.sqrt(99));
     }
 }  