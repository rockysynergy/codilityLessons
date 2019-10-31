import java.util.ArrayList;
import java.util.LinkedList;

class Peaks {

    public int solution(int[] A) {
        int L = A.length;

        LinkedList<Integer> peaks = new LinkedList<>();
        for (int i = 1; i < L - 1; i++) {
            if (A[i-1] < A[i] && A[i] > A[i+1]) peaks.add(i);
        }

        for (int size = 1; size <= L; size++) {
            if (L % size != 0) continue;
            int find = 0;
            int groups = L / size;
            boolean ok = true;

            for (int pIdx : peaks) {
                int div = pIdx / size;
                if (div > find) {
                    ok = false;
                    break;
                }

                if (div == find) find++;
            }

            if (find != groups) ok = false;
            if (ok) return groups;
        }

        return 0;
    }

    public static void main(String[] args) {
        Peaks p = new Peaks();
        // int[] A = new int[] {1,2,1,2,1,2};
        int[] B = new int[]{1,2,3,3,3,4,1,2,3,4,6,2};
        System.out.println("The answer: " + p.solution(B));
    }
}